import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/logistics/data/models/logistics_models.dart';
import 'package:mobile/features/logistics/presentation/providers/logistics_provider.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/core/utils/validation_utils.dart';
import 'package:mobile/shared/widgets/status_widgets.dart';

class ShippingCalculatorScreen extends ConsumerStatefulWidget {
  const ShippingCalculatorScreen({super.key});

  @override
  ConsumerState<ShippingCalculatorScreen> createState() => _ShippingCalculatorScreenState();
}

class _ShippingCalculatorScreenState extends ConsumerState<ShippingCalculatorScreen> with SingleTickerProviderStateMixin {
  final _formKey = GlobalKey<FormState>();
  final _originController = TextEditingController();
  final _destinationController = TextEditingController();
  final _weightController = TextEditingController();

  List<ShippingRate>? _rates;
  bool _isLoading = false;

  late AnimationController _controller;
  late Animation<double> _fadeAnimation;
  late Animation<Offset> _slideAnimation;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
      duration: const Duration(milliseconds: 800),
      vsync: this,
    );
    _fadeAnimation = CurvedAnimation(parent: _controller, curve: Curves.easeIn);
    _slideAnimation = Tween<Offset>(begin: const Offset(0, 0.2), end: Offset.zero)
        .animate(CurvedAnimation(parent: _controller, curve: Curves.easeOut));
    _controller.forward();
  }

  @override
  void dispose() {
    _controller.dispose();
    _originController.dispose();
    _destinationController.dispose();
    _weightController.dispose();
    super.dispose();
  }

  void _calculateRates() async {
    if (_formKey.currentState!.validate()) {
      setState(() => _isLoading = true);
      final weight = double.tryParse(_weightController.text);
      if (weight != null) {
        try {
          // Simulate network delay for effect
          await Future.delayed(const Duration(milliseconds: 1500));
          final repository = ref.read(logisticsRepositoryProvider);
          final rates = await repository.getRates(
            origin: _originController.text,
            destination: _destinationController.text,
            weight: weight,
          );
          if (mounted) {
            setState(() {
              _rates = rates;
              _isLoading = false;
            });
          }
        } catch (e) {
          if (mounted) {
            setState(() => _isLoading = false);
            ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text(e.toString())));
          }
        }
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF002366),
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        title: const Text('Get a Quote', style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
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
          // Background
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
          // Decorative circles
          Positioned(
            top: -100,
            right: -100,
            child: Container(
              width: 300,
              height: 300,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                boxShadow: [
                  BoxShadow(
                    color: const Color(0xFFFFD700).withOpacity(0.1),
                    blurRadius: 50,
                    spreadRadius: 10,
                  ),
                ],
              ),
            ),
          ),
           SafeArea(
            child: Padding(
              padding: const EdgeInsets.all(24.0),
              child: FadeTransition(
                opacity: _fadeAnimation,
                child: SlideTransition(
                  position: _slideAnimation,
                  child: Column(
                    children: [
                      // Calculator Form Card
                      Container(
                        padding: const EdgeInsets.all(24),
                        decoration: BoxDecoration(
                          color: Colors.white.withOpacity(0.05),
                          borderRadius: BorderRadius.circular(24),
                          border: Border.all(color: Colors.white.withOpacity(0.1)),
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withOpacity(0.2),
                              blurRadius: 20,
                              offset: const Offset(0, 10),
                            ),
                          ],
                        ),
                        child: Form(
                          key: _formKey,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.stretch,
                            children: [
                              _buildTextField(
                                controller: _originController,
                                label: 'Origin City',
                                icon: Icons.flight_takeoff,
                              ),
                              const SizedBox(height: 16),
                              _buildTextField(
                                controller: _destinationController,
                                label: 'Destination City',
                                icon: Icons.flight_land,
                              ),
                              const SizedBox(height: 16),
                              _buildTextField(
                                controller: _weightController,
                                label: 'Weight (kg)',
                                icon: Icons.scale,
                                isNumber: true,
                              ),
                              const SizedBox(height: 24),
                              ElevatedButton(
                                onPressed: _isLoading ? null : _calculateRates,
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: const Color(0xFFFFD700),
                                  foregroundColor: const Color(0xFF002366),
                                  padding: const EdgeInsets.symmetric(vertical: 16),
                                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                                  elevation: 5,
                                ),
                                child: _isLoading
                                    ? const SizedBox(width: 24, height: 24, child: CircularProgressIndicator(color: Color(0xFF002366), strokeWidth: 2))
                                    : const Text('CALCULATE RATES', style: TextStyle(fontWeight: FontWeight.bold, letterSpacing: 1)),
                              ),
                            ],
                          ),
                        ),
                      ),
                      const SizedBox(height: 32),
                      
                      // Results Area
                      if (_rates != null)
                        Expanded(
                          child: AnimationLimiter(
                            child: ListView.builder(
                              itemCount: _rates!.length,
                              itemBuilder: (context, index) {
                                final rate = _rates![index];
                                return AnimationConfiguration.staggeredList(
                                  position: index,
                                  duration: const Duration(milliseconds: 500),
                                  child: SlideAnimation(
                                    verticalOffset: 50.0,
                                    child: FadeInAnimation(
                                      child: Container(
                                        margin: const EdgeInsets.only(bottom: 16),
                                        decoration: BoxDecoration(
                                          color: Colors.white,
                                          borderRadius: BorderRadius.circular(16),
                                          boxShadow: [
                                            BoxShadow(color: Colors.black.withOpacity(0.1), blurRadius: 10, offset: const Offset(0, 4)),
                                          ],
                                        ),
                                        child: ListTile(
                                          contentPadding: const EdgeInsets.all(16),
                                          leading: Container(
                                            padding: const EdgeInsets.all(12),
                                            decoration: BoxDecoration(
                                              color: const Color(0xFFF0F4F8),
                                              borderRadius: BorderRadius.circular(12),
                                            ),
                                            child: const Icon(Icons.local_shipping, color: Color(0xFF002366)),
                                          ),
                                          title: Text(rate.serviceName, style: const TextStyle(fontWeight: FontWeight.bold, color: Color(0xFF002366), fontFamily: 'Outfit')),
                                          subtitle: Text("Est. delivery: ${rate.estimatedDays}", style: TextStyle(color: Colors.grey[600])),
                                          trailing: Column(
                                            mainAxisAlignment: MainAxisAlignment.center,
                                            crossAxisAlignment: CrossAxisAlignment.end,
                                            children: [
                                              Text(
                                                '${rate.currency} ${rate.price.toStringAsFixed(2)}',
                                                style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 18, color: Color(0xFF002366), fontFamily: 'Outfit'),
                                              ),
                                              const Text("Total", style: TextStyle(fontSize: 10, color: Colors.grey)),
                                            ],
                                          ),
                                        ),
                                      ),
                                    ),
                                  ),
                                );
                              },
                            ),
                          ),
                        )
                      else if (!_isLoading)
                        Expanded(
                          child: Center(
                            child: Column(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Icon(Icons.calculate_outlined, size: 80, color: Colors.white.withOpacity(0.2)),
                                const SizedBox(height: 16),
                                Text("Enter details to get quotes", style: TextStyle(color: Colors.white.withOpacity(0.6), fontSize: 16, fontFamily: 'Outfit')),
                              ],
                            ),
                          ),
                        ),
                    ],
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildTextField({
    required TextEditingController controller,
    required String label,
    required IconData icon,
    bool isNumber = false,
  }) {
    return TextFormField(
      controller: controller,
      keyboardType: isNumber ? TextInputType.number : TextInputType.text,
      style: const TextStyle(color: Colors.white),
      decoration: InputDecoration(
        labelText: label,
        labelStyle: TextStyle(color: Colors.white.withOpacity(0.6)),
        prefixIcon: Icon(icon, color: Colors.white.withOpacity(0.6)),
        filled: true,
        fillColor: Colors.white.withOpacity(0.1),
        border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
        enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide(color: Colors.white.withOpacity(0.1))),
        focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: const BorderSide(color: Color(0xFFFFD700))),
      ),
      validator: (v) => ValidationUtils.validateRequired(v, label),
    );
  }
}

// Simple Animation Helpers (usually in a separate package like flutter_staggered_animations, but kept inline for simplicity if package not present)
class AnimationLimiter extends StatelessWidget {
  final Widget child;
  const AnimationLimiter({super.key, required this.child});
  @override Widget build(BuildContext context) => child;
}
class AnimationConfiguration extends StatelessWidget {
  final int position;
  final Duration duration;
  final Widget child;
  const AnimationConfiguration.staggeredList({super.key, required this.position, required this.duration, required this.child});
  @override Widget build(BuildContext context) => child;
}
class SlideAnimation extends StatelessWidget {
  final double verticalOffset;
  final Widget child;
  const SlideAnimation({super.key, required this.verticalOffset, required this.child});
  @override Widget build(BuildContext context) => child; // Placeholder for actual animation logic if package missing
}
class FadeInAnimation extends StatelessWidget {
  final Widget child;
  const FadeInAnimation({super.key, required this.child});
  @override Widget build(BuildContext context) => child; // Placeholder
}

