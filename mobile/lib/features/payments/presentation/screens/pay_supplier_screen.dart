import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';

// You'll need to create a provider for this logic, but for now we'll put UI first
import 'package:mobile/core/network/api_client.dart'; 

class PaySupplierScreen extends ConsumerStatefulWidget {
  const PaySupplierScreen({super.key});

  @override
  ConsumerState<PaySupplierScreen> createState() => _PaySupplierScreenState();
}

class _PaySupplierScreenState extends ConsumerState<PaySupplierScreen> {
  final _formKey = GlobalKey<FormState>();
  final _beneficiaryNameController = TextEditingController();
  final _accountNumberController = TextEditingController();
  final _amountController = TextEditingController();
  final _bankCodeController = TextEditingController(); // For Fincra/Bank
  final _bankNameController = TextEditingController();
  final _descriptionController = TextEditingController();

  String _sourceCurrency = 'NGN'; // Default Source
  String _destCurrency = 'NGN';   // Default Destination
  
  bool _isLoading = false;

  final List<String> _currencies = ['NGN', 'USD', 'CNY'];

  Future<void> _submit() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() => _isLoading = true);

    try {
      final dio = ref.read(dioProvider);
      
      final payload = {
        'amount': double.parse(_amountController.text),
        'currency': _destCurrency,
        'source_currency': _sourceCurrency,
        'beneficiary_name': _beneficiaryNameController.text,
        'account_number': _accountNumberController.text,
        'bank_code': _bankCodeController.text.isNotEmpty ? _bankCodeController.text : null,
        'bank_name': _bankNameController.text,
        'description': _descriptionController.text,
      };

      await dio.post('/pay-supplier', data: payload);

      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Supplier Payment Initiated Successfully!')),
        );
        context.pop();
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Payment Failed: ${e.toString()}')),
        );
      }
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Pay Supplier")),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Form(
          key: _formKey,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              _buildConfigSection(),
              const SizedBox(height: 24),
              _buildBeneficiaryForm(),
              const SizedBox(height: 32),
              SizedBox(
                width: double.infinity,
                height: 50,
                child: ElevatedButton(
                  onPressed: _isLoading ? null : _submit,
                  child: _isLoading 
                    ? const CircularProgressIndicator(color: Colors.white) 
                    : const Text("Initiate Payout"),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildConfigSection() {
    return Card(
      child: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            Row(
              children: [
                Expanded(
                  child: _buildDropdown("Pay From (Wallet)", _sourceCurrency, (val) {
                    setState(() => _sourceCurrency = val!);
                  }),
                ),
                const SizedBox(width: 16),
                const Icon(Icons.arrow_forward),
                const SizedBox(width: 16),
                Expanded(
                  child: _buildDropdown("Pay To (Currency)", _destCurrency, (val) {
                    setState(() => _destCurrency = val!);
                  }),
                ),
              ],
            ),
             const SizedBox(height: 16),
             TextFormField(
              controller: _amountController,
              keyboardType: const TextInputType.numberWithOptions(decimal: true),
              decoration: const InputDecoration(
                labelText: "Amount",
                border: OutlineInputBorder(),
                prefixIcon: Icon(Icons.monetization_on_outlined),
              ),
              validator: (val) => val == null || val.isEmpty ? 'Amount is required' : null,
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildBeneficiaryForm() {
    bool isChina = _destCurrency == 'CNY';

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text("Beneficiary Details", style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
        const SizedBox(height: 16),
        TextFormField(
          controller: _beneficiaryNameController,
          decoration: const InputDecoration(labelText: "Beneficiary Name"),
          validator: (val) => val!.isEmpty ? 'Name is required' : null,
        ),
        const SizedBox(height: 16),
        TextFormField(
          controller: _accountNumberController,
          decoration: InputDecoration(
            labelText: isChina ? "Alipay/WeChat ID" : "Account Number / IBAN",
            hintText: isChina ? "Email or Phone Number" : "1234567890",
          ),
          validator: (val) => val!.isEmpty ? 'Account details required' : null,
        ),
        if (!isChina) ...[
          const SizedBox(height: 16),
          TextFormField(
            controller: _bankCodeController,
            decoration: const InputDecoration(labelText: "Bank Code / Sort Code"),
          ),
          const SizedBox(height: 16),
          TextFormField(
            controller: _bankNameController,
            decoration: const InputDecoration(labelText: "Bank Name"),
          ),
        ] else ...[
           // China Specific Fields? Usually Name + Alipay ID is enough for Klasha
           const SizedBox(height: 16),
           const Text("Note: Payouts to China are processed via Klasha (Alipay/WeChat).", 
              style: TextStyle(color: Colors.grey, fontSize: 12)),
        ],
        const SizedBox(height: 16),
        TextFormField(
          controller: _descriptionController,
          decoration: const InputDecoration(labelText: "Description / Reference"),
        ),
      ],
    );
  }

  Widget _buildDropdown(String label, String value, ValueChanged<String?> onChanged) {
    return DropdownButtonFormField<String>(
      value: value,
      decoration: InputDecoration(labelText: label, border: const OutlineInputBorder()),
      items: _currencies.map((c) => DropdownMenuItem(value: c, child: Text(c))).toList(),
      onChanged: onChanged,
    );
  }
}
