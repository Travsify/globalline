import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/marketplace/presentation/providers/cart_provider.dart';

class CheckoutScreen extends ConsumerStatefulWidget {
  const CheckoutScreen({super.key});

  @override
  ConsumerState<CheckoutScreen> createState() => _CheckoutScreenState();
}

class _CheckoutScreenState extends ConsumerState<CheckoutScreen> {
  bool _isLoading = false;
  String _loadingMessage = "Processing Payment...";

  @override
  Widget build(BuildContext context) {
    final cartItems = ref.watch(cartProvider);
    final total = ref.watch(cartTotalProvider);
    final symbol = ref.watch(cartSymbolProvider);
    final shippingFee = symbol == '₦' ? 22500.0 : (symbol == 'TL' ? 450.0 : 15.0);
    final grandTotal = total + shippingFee;

    return Scaffold(
      backgroundColor: const Color(0xFF002366),
      appBar: AppBar(
        title: const Text('Checkout', style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        centerTitle: true,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios, color: Colors.white),
          onPressed: () => context.pop(),
        ),
      ),
      body: Stack(
        children: [
          // Background Gradient
          Positioned.fill(
            child: Container(
              decoration: const BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment.topCenter,
                  end: Alignment.bottomCenter,
                  colors: [
                    Color(0xFF002366),
                    Color(0xFF001540),
                  ],
                ),
              ),
            ),
          ),
          SingleChildScrollView(
            padding: const EdgeInsets.all(24.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                 // Order Summary
                _buildSectionTitle("Order Summary"),
                Container(
                  padding: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.05),
                    borderRadius: BorderRadius.circular(20),
                    border: Border.all(color: Colors.white.withOpacity(0.1)),
                  ),
                  child: Column(
                    children: [
                       ...cartItems.map((item) => Padding(
                         padding: const EdgeInsets.only(bottom: 12.0),
                         child: Row(
                           children: [
                             Text("${item.quantity}x ${item.product.title}", style: const TextStyle(fontSize: 14, color: Colors.white70, fontFamily: 'Outfit')),
                             const Spacer(),
                             Text(
                               "${item.product.symbol}${item.total.toStringAsFixed(2)}",
                               style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
                             ),
                           ],
                         ),
                       )),
                       Divider(color: Colors.white.withOpacity(0.1)),
                       const SizedBox(height: 8),
                       _buildSummaryRow("Subtotal", "$symbol${total.toStringAsFixed(2)}"),
                       const SizedBox(height: 8),
                       _buildSummaryRow("Estimated Shipping", "$symbol${shippingFee.toStringAsFixed(2)}"),
                       const SizedBox(height: 12),
                       Divider(color: Colors.white.withOpacity(0.1)),
                       const SizedBox(height: 4),
                       Row(
                         children: [
                           const Text("Total", style: TextStyle(fontWeight: FontWeight.bold, fontSize: 18, color: Colors.white, fontFamily: 'Outfit')),
                           const Spacer(),
                           Text("$symbol${grandTotal.toStringAsFixed(2)}", style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 20, color: Color(0xFFFFD700), fontFamily: 'Outfit')),
                         ],
                       ),
                    ],
                  ),
                ),
                const SizedBox(height: 32),

                // Collective Sync Indicator
                Container(
                  padding: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    color: const Color(0xFFFFD700).withOpacity(0.1),
                    borderRadius: BorderRadius.circular(16),
                    border: Border.all(color: const Color(0xFFFFD700).withOpacity(0.3)),
                  ),
                  child: Row(
                    children: [
                      const Icon(Icons.sync, color: Color(0xFFFFD700), size: 20),
                      const SizedBox(width: 12),
                      const Expanded(
                        child: Text(
                          "Collective Cart Synchronization Active",
                          style: TextStyle(color: Colors.white, fontSize: 12, fontWeight: FontWeight.bold),
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 32),

                // Shipping Address (Mock)
                _buildSectionTitle("Shipping Address"),
                Container(
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.05),
                    borderRadius: BorderRadius.circular(20),
                    border: Border.all(color: Colors.white.withOpacity(0.1)),
                  ),
                  child: ListTile(
                    leading: Container(
                      padding: const EdgeInsets.all(8),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.1),
                        shape: BoxShape.circle,
                      ),
                      child: const Icon(Icons.location_on, color: Color(0xFFFFD700)),
                    ),
                    title: const Text("John Doe", style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                    subtitle: const Text("123 Main St, New York, NY 10001, USA", style: TextStyle(color: Colors.white70)),
                    trailing: TextButton(
                      onPressed: (){}, 
                      child: const Text("Change", style: TextStyle(color: Color(0xFFFFD700)))
                    ),
                  ),
                ),
                 const SizedBox(height: 32),

                // Payment Method
                _buildSectionTitle("Payment Method"),
                Container(
                  decoration: BoxDecoration(
                     color: Colors.white.withOpacity(0.05),
                     borderRadius: BorderRadius.circular(20),
                     border: Border.all(color: Colors.white.withOpacity(0.1)),
                  ),
                  child: ListTile(
                    leading: Container(
                      padding: const EdgeInsets.all(8),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.1),
                        shape: BoxShape.circle,
                      ),
                      child: const Icon(Icons.account_balance_wallet, color: Color(0xFFFFD700)),
                    ),
                    title: const Text("Wallet Balance", style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                    subtitle: Text("Available: $symbol 3,450.00", style: const TextStyle(color: Colors.white70)),
                    trailing: const Icon(Icons.check_circle, color: Color(0xFFFFD700)),
                  ),
                ),
                const SizedBox(height: 48),

                SizedBox(
                  height: 56,
                  child: ElevatedButton(
                    onPressed: _isLoading ? null : _placeOrder,
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFFFFD700),
                      foregroundColor: const Color(0xFF002366),
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                      elevation: 5,
                    ),
                    child: _isLoading 
                      ? Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            const SizedBox(
                              width: 20, 
                              height: 20, 
                              child: CircularProgressIndicator(color: Color(0xFF002366), strokeWidth: 2)
                            ),
                            const SizedBox(width: 12),
                            Text(_loadingMessage, style: const TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
                          ],
                        )
                      : Text(
                          "PAY $symbol${grandTotal.toStringAsFixed(2)}", 
                          style: const TextStyle(fontSize: 18, fontWeight: FontWeight.bold, letterSpacing: 1),
                        ),
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildSectionTitle(String title) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12.0),
      child: Text(
        title,
        style: const TextStyle(
          fontSize: 18, 
          fontWeight: FontWeight.bold, 
          color: Colors.white,
          fontFamily: 'Outfit',
        ),
      ),
    );
  }

  Widget _buildSummaryRow(String label, String value) {
    return Row(
      children: [
        Text(label, style: const TextStyle(color: Colors.white70)),
        const Spacer(),
        Text(value, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
      ],
    );
  }

  void _placeOrder() async {
    setState(() {
      _isLoading = true;
      _loadingMessage = "Syncing Collective Cart...";
    });
    
    // Simulate Collective Settle Sync
    await Future.delayed(const Duration(seconds: 1));
    
    if (mounted) {
      setState(() => _loadingMessage = "Authorizing Trade Protocol...");
    }
    
    await Future.delayed(const Duration(seconds: 1));

    if (mounted) {
      setState(() => _loadingMessage = "Processing Payment...");
    }

    await Future.delayed(const Duration(seconds: 1));

    if (mounted) {
      ref.read(cartProvider.notifier).clearCart();
      setState(() => _isLoading = false);

      context.push('/checkout/payment', extra: {
        'amount': grandTotal,
        'currency': symbol == '₦' ? 'NGN' : (symbol == 'TL' ? 'TRY' : 'USD'),
        'email': 'user@globalline.com', // Mock email for now
      });
    }
  }
}
