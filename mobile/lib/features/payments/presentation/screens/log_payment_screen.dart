
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../providers/supplier_payment_provider.dart';

class LogPaymentScreen extends ConsumerStatefulWidget {
  const LogPaymentScreen({super.key});

  @override
  ConsumerState<LogPaymentScreen> createState() => _LogPaymentScreenState();
}

class _LogPaymentScreenState extends ConsumerState<LogPaymentScreen> {
  final _formKey = GlobalKey<FormState>();
  final _supplierNameController = TextEditingController();
  final _amountController = TextEditingController();
  String _currency = 'USD';
  final _accountNumberController = TextEditingController();
  final _bankNameController = TextEditingController();
  final _swiftCodeController = TextEditingController();
  final _notesController = TextEditingController();

  @override
  void dispose() {
    _supplierNameController.dispose();
    _amountController.dispose();
    _accountNumberController.dispose();
    _bankNameController.dispose();
    _swiftCodeController.dispose();
    _notesController.dispose();
    super.dispose();
  }

  Future<void> _submit() async {
    if (_formKey.currentState!.validate()) {
      final success = await ref.read(supplierPaymentControllerProvider.notifier).logPayment(
        supplierName: _supplierNameController.text,
        amount: double.parse(_amountController.text),
        currency: _currency,
        accountNumber: _accountNumberController.text.isEmpty ? null : _accountNumberController.text,
        bankName: _bankNameController.text.isEmpty ? null : _bankNameController.text,
        swiftCode: _swiftCodeController.text.isEmpty ? null : _swiftCodeController.text,
        notes: _notesController.text.isEmpty ? null : _notesController.text,
      );

      if (success && mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Payment logged successfully')),
        );
        context.pop();
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final state = ref.watch(supplierPaymentControllerProvider);

    return Scaffold(
      appBar: AppBar(title: const Text('Log Supplier Payment')),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Form(
          key: _formKey,
          child: ListView(
            children: [
              if (state.error != null)
                Padding(
                  padding: const EdgeInsets.only(bottom: 16),
                  child: Text(state.error!, style: const TextStyle(color: Colors.red)),
                ),
              TextFormField(
                controller: _supplierNameController,
                decoration: const InputDecoration(labelText: 'Supplier Name *'),
                validator: (v) => v!.isEmpty ? 'Supplier name is required' : null,
              ),
              const SizedBox(height: 16),
              Row(
                children: [
                  Expanded(
                    flex: 2,
                    child: TextFormField(
                      controller: _amountController,
                      decoration: const InputDecoration(labelText: 'Amount *'),
                      keyboardType: const TextInputType.numberWithOptions(decimal: true),
                      validator: (v) => v!.isEmpty ? 'Amount is required' : null,
                    ),
                  ),
                  const SizedBox(width: 16),
                  Expanded(
                    flex: 1,
                    child: DropdownButtonFormField<String>(
                      value: _currency,
                      decoration: const InputDecoration(labelText: 'Currency'),
                      items: ['USD', 'CNY', 'NGN'].map((e) => DropdownMenuItem(value: e, child: Text(e))).toList(),
                      onChanged: (v) => setState(() => _currency = v!),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _accountNumberController,
                decoration: const InputDecoration(labelText: 'Account Number'),
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _bankNameController,
                decoration: const InputDecoration(labelText: 'Bank Name'),
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _swiftCodeController,
                decoration: const InputDecoration(labelText: 'SWIFT Code (Optional)'),
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _notesController,
                decoration: const InputDecoration(labelText: 'Notes (Optional)'),
                maxLines: 3,
              ),
              const SizedBox(height: 24),
              ElevatedButton(
                onPressed: state.isLoading ? null : _submit,
                child: state.isLoading ? const CircularProgressIndicator() : const Text('Log Payment'),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
