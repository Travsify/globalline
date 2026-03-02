import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/wallet/presentation/providers/wallet_provider.dart';
import 'package:mobile/features/wallet/data/models/wallet_models.dart';
import 'package:mobile/shared/widgets/status_widgets.dart';

class CurrencyConversionScreen extends ConsumerStatefulWidget {
  const CurrencyConversionScreen({super.key});

  @override
  ConsumerState<CurrencyConversionScreen> createState() => _CurrencyConversionScreenState();
}

class _CurrencyConversionScreenState extends ConsumerState<CurrencyConversionScreen> {
  final _amountController = TextEditingController();
  String _fromCurrency = 'NGN';
  String _toCurrency = 'USD';
  bool _isConverting = false;

  final List<String> _currencies = ['USD', 'NGN', 'CNY'];

  @override
  void dispose() {
    _amountController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final balancesAsync = ref.watch(multiCurrencyBalancesProvider);

    return Scaffold(
      backgroundColor: const Color(0xFF002366),
      appBar: AppBar(
        title: const Text('Convert Currency', 
          style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
      ),
      body: balancesAsync.when(
        data: (balances) {
          return SingleChildScrollView(
            padding: const EdgeInsets.all(24),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                _buildBalanceRibbon(balances),
                const SizedBox(height: 32),
                _buildConversionCard(),
                const SizedBox(height: 40),
                ElevatedButton(
                  onPressed: _isConverting ? null : _convert,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFFFFD700),
                    foregroundColor: const Color(0xFF002366),
                    padding: const EdgeInsets.symmetric(vertical: 18),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                  ),
                  child: _isConverting 
                    ? const CircularProgressIndicator()
                    : const Text("CONVERT NOW", style: TextStyle(fontWeight: FontWeight.bold)),
                ),
              ],
            ),
          );
        },
        loading: () => const AppLoadingWidget(),
        error: (err, stack) => AppErrorWidget(message: err.toString()),
      ),
    );
  }

  Widget _buildBalanceRibbon(List<CurrencyBalance> balances) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: Colors.white.withOpacity(0.1)),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: balances.map((b) {
          String symbol = '';
          if (b.currency == 'NGN') symbol = '₦';
          if (b.currency == 'USD') symbol = '\$';
          if (b.currency == 'CNY') symbol = '¥';
          return Column(
            children: [
              Text(b.currency, style: const TextStyle(color: Colors.white70, fontSize: 12)),
              const SizedBox(height: 4),
              Text("$symbol${b.amount.toStringAsFixed(2)}", style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
            ],
          );
        }).toList(),
      ),
    );
  }

  Widget _buildConversionCard() {
    return Container(
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.1),
        borderRadius: BorderRadius.circular(24),
      ),
      child: Column(
        children: [
          _buildCurrencyDropdown("From", _fromCurrency, (val) => setState(() => _fromCurrency = val!)),
          const Padding(
            padding: EdgeInsets.symmetric(vertical: 16),
            child: Icon(Icons.swap_vert, color: Color(0xFFFFD700), size: 32),
          ),
          _buildCurrencyDropdown("To", _toCurrency, (val) => setState(() => _toCurrency = val!)),
          const SizedBox(height: 24),
          TextField(
            controller: _amountController,
            keyboardType: TextInputType.number,
            style: const TextStyle(color: Colors.white, fontSize: 24, fontWeight: FontWeight.bold),
            textAlign: TextAlign.center,
            decoration: InputDecoration(
              hintText: "0.00",
              hintStyle: TextStyle(color: Colors.white.withOpacity(0.3)),
              labelText: "Amount to Convert",
              labelStyle: TextStyle(color: Colors.white.withOpacity(0.6)),
              border: InputBorder.none,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildCurrencyDropdown(String label, String value, ValueChanged<String?> onChanged) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label, style: TextStyle(color: Colors.white.withOpacity(0.6), fontSize: 12)),
        const SizedBox(height: 8),
        DropdownButtonFormField<String>(
          value: value,
          onChanged: onChanged,
          dropdownColor: const Color(0xFF002366),
          style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
          decoration: InputDecoration(
            filled: true,
            fillColor: Colors.white.withOpacity(0.05),
            border: OutlineInputBorder(borderRadius: BorderRadius.circular(12), borderSide: BorderSide.none),
          ),
          items: _currencies.map((c) => DropdownMenuItem(value: c, child: Text(c))).toList(),
        ),
      ],
    );
  }

  void _convert() async {
    final amountText = _amountController.text;
    if (amountText.isEmpty) return;
    
    final amount = double.tryParse(amountText);
    if (amount == null || amount <= 0) return;

    setState(() => _isConverting = true);
    try {
      await ref.read(walletControllerProvider.notifier).convert(
        from: _fromCurrency,
        to: _toCurrency,
        amount: amount,
      );
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text("Conversion successful!")),
        );
        context.pop();
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text("Error: $e")),
        );
      }
    } finally {
      if (mounted) setState(() => _isConverting = false);
    }
  }
}
