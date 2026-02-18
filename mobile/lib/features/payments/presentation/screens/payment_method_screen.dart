
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/core/network/api_client.dart';
import 'package:mobile/features/payments/data/services/payment_service.dart';
import 'package:mobile/features/wallet/presentation/providers/wallet_provider.dart';

class PaymentMethodScreen extends ConsumerStatefulWidget {
  final double amount;
  final String currency;
  final String email;
  final bool isFunding; // New flag

  const PaymentMethodScreen({
    super.key,
    required this.amount,
    required this.currency,
    required this.email,
    this.isFunding = false,
  });

  @override
  ConsumerState<PaymentMethodScreen> createState() => _PaymentMethodScreenState();
}

class _PaymentMethodScreenState extends ConsumerState<PaymentMethodScreen> {
  bool _isLoading = false;

  Future<void> _processPayment(String gateway) async {
    setState(() => _isLoading = true);
    try {
      final paymentService = ref.read(paymentServiceProvider);
      
      if (gateway == 'wallet') {
          // Process Wallet Payment (Deduction)
          final walletRepo = ref.read(walletRepositoryProvider); // Access via provider, need to ensure it's available or use dio directly
          // For simplicity/speed using apiClient/dio via provider if repository not exposed here, 
          // or better: utilize the walletController which uses repository.
          // Let's assume we can access the repository or call API directly.
          // Since we don't have walletRepositoryProvider readily imported, let's use the apiClient from paymentService or similar.
          // Actually, let's use the paymentService to handle this "wallet" gateway logic if we extend it, 
          // OR better, just call the API endpoint directly here using the same dio instance or ref.
          
          // To keep it clean, let's assume we can add `payWithWallet` to PaymentService or use Dio.
          // Quickest valid way:
          final dio = ref.read(apiClientProvider);
          await dio.post('wallet/deduct', data: {
            'amount': widget.amount,
            'description': 'Payment for Order',
          });
          
          if (mounted) {
             _handleSuccess("Paid with Wallet!");
          }
          return;
      }

      // 1. Initialize Gateway Payment
      final data = await paymentService.initializePayment(
        amount: widget.amount,
        currency: widget.currency,
        gateway: gateway,
        email: widget.email,
      );

      // 2. Process based on gateway
      if (gateway == 'stripe') {
        await paymentService.processStripePayment(
          clientSecret: data['client_secret'],
          publishableKey: data['publishable_key'],
        );
      } else if (gateway == 'paystack') {
        if (!mounted) return;
        await paymentService.processPaystackPayment(
          context: context,
          accessCode: data['access_code'],
          reference: data['reference'],
          email: widget.email,
          amount: widget.amount,
          publicKey: data['public_key'],
        );
      }
      
      // 3. Post-Process: If this was a Funding operation, credit the wallet
      if (widget.isFunding) {
         final dio = ref.read(apiClientProvider);
         await dio.post('wallet/fund', data: {
            'amount': widget.amount,
            'currency': widget.currency, // Send selected currency
         });
         if (mounted) _handleSuccess("Wallet Funded Successfully!");
      } else {
         if (mounted) _handleSuccess("Payment Successful!");
      }

    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Error: $e'), backgroundColor: Colors.red),
        );
      }
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  void _handleSuccess(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(message), backgroundColor: Colors.green),
    );
    // Refresh wallet if needed
    ref.invalidate(walletControllerProvider); // Assuming import
    context.go('/dashboard'); 
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text(widget.isFunding ? "Fund Wallet" : "Select Payment Method")),
      body: _isLoading
          ? const Center(child: CircularProgressIndicator())
          : Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.stretch,
                children: [
                  Text(
                    "Amount: ${widget.currency} ${widget.amount.toStringAsFixed(2)}",
                    style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                    textAlign: TextAlign.center,
                  ),
                  const SizedBox(height: 32),
                  
                  // Wallet Payment Option (Only if NOT funding)
                  if (!widget.isFunding) ...[
                    ElevatedButton.icon(
                      onPressed: () => _processPayment('wallet'),
                      icon: const Icon(Icons.account_balance_wallet),
                      label: const Text("Pay with Wallet Balance"),
                      style: ElevatedButton.styleFrom(
                        padding: const EdgeInsets.all(16),
                        backgroundColor: const Color(0xFF002366),
                        foregroundColor: Colors.white,
                      ),
                    ),
                    const SizedBox(height: 16),
                    const Divider(),
                    const SizedBox(height: 16),
                  ],

                  // Stripe
                  ElevatedButton.icon(
                    onPressed: () => _processPayment('stripe'),
                    icon: const Icon(Icons.credit_card),
                    label: const Text("Pay with Card (Global - Stripe)"),
                    style: ElevatedButton.styleFrom(
                      padding: const EdgeInsets.all(16),
                      backgroundColor: const Color(0xFF6772E5),
                      foregroundColor: Colors.white,
                    ),
                  ),
                  const SizedBox(height: 16),
                  // Paystack
                  ElevatedButton.icon(
                    onPressed: () => _processPayment('paystack'),
                    icon: const Icon(Icons.payment),
                    label: const Text("Pay with Bank/Card (Africa - Paystack)"),
                    style: ElevatedButton.styleFrom(
                      padding: const EdgeInsets.all(16),
                      backgroundColor: const Color(0xFF0BA4DB), // Paystack Blue-ish
                      foregroundColor: Colors.white,
                    ),
                  ),
                ],
              ),
            ),
    );
  }
}
