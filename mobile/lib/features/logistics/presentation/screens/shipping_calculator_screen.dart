import 'dart:ui';
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

class _ShippingCalculatorScreenState extends ConsumerState<ShippingCalculatorScreen> with TickerProviderStateMixin {
  final _formKey = GlobalKey<FormState>();
  final _originController = TextEditingController();
  final _destinationController = TextEditingController();
  final _weightController = TextEditingController();

  List<ShippingRate>? _rates;
  bool _isLoading = false;
  bool _showQuantumResult = false;

  late AnimationController _quantumController;

  @override
  void initState() {
    super.initState();
    _quantumController = AnimationController(
      duration: const Duration(seconds: 4),
      vsync: this,
    )..repeat();
  }

  @override
  void dispose() {
    _quantumController.dispose();
    _originController.dispose();
    _destinationController.dispose();
    _weightController.dispose();
    super.dispose();
  }

  void _calculateRates() async {
    if (_formKey.currentState!.validate()) {
      setState(() {
        _isLoading = true;
        _showQuantumResult = false;
      });
      final weight = double.tryParse(_weightController.text);
      if (weight != null) {
        try {
          // Quantum Simulation Effect
          await Future.delayed(const Duration(seconds: 3));
          
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
              _showQuantumResult = true;
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
      backgroundColor: const Color(0xFF001540), // GlobalLine Deep Navy
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        title: const Text('Quantum Trade Oracle', 
          style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold, letterSpacing: 2, color: Color(0xFFFFD700))),
        backgroundColor: Colors.transparent,
        elevation: 0,
        centerTitle: true,
        leading: IconButton(
          icon: const Icon(Icons.blur_on, color: Color(0xFFFFD700)),
          onPressed: () => context.pop(),
        ),
      ),
      body: Stack(
        children: [
          _buildQuantumField(),
          SafeArea(
            child: SingleChildScrollView(
              padding: const EdgeInsets.all(24.0),
              child: Column(
                children: [
                  _buildOracleHeader(),
                  const SizedBox(height: 32),
                  _buildInputChamber(),
                  const SizedBox(height: 32),
                  if (_isLoading) _buildQuantumProcessor(),
                  if (_showQuantumResult && _rates != null) ...[
                    _buildResultChamber(),
                  ],
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildQuantumField() {
    return Positioned.fill(
      child: AnimatedBuilder(
        animation: _quantumController,
        builder: (context, child) {
          return CustomPaint(
            painter: _QuantumFieldPainter(_quantumController.value),
          );
        },
      ),
    );
  }

  Widget _buildOracleHeader() {
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: const Color(0xFFFFD700).withOpacity(0.05),
        borderRadius: BorderRadius.circular(20),
        border: Border.all(color: const Color(0xFFFFD700).withOpacity(0.2)),
      ),
      child: Row(
        children: [
          const Icon(Icons.auto_awesome, color: Color(0xFFFFD700), size: 28),
          const SizedBox(width: 16),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const Text("DESTINY ENGINE v8.0", 
                  style: TextStyle(color: Color(0xFFFFD700), fontWeight: FontWeight.bold, fontSize: 10, letterSpacing: 2)),
                const SizedBox(height: 4),
                Text("Predicting global logistics across 4 dimensions.", 
                  style: TextStyle(color: Colors.white.withOpacity(0.5), fontSize: 12)),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildInputChamber() {
    return Container(
      padding: const EdgeInsets.all(32),
      decoration: BoxDecoration(
        color: Colors.black.withOpacity(0.6),
        borderRadius: BorderRadius.circular(32),
        border: Border.all(color: Colors.white10),
        boxShadow: [
          BoxShadow(color: const Color(0xFFFFD700).withOpacity(0.05), blurRadius: 40, spreadRadius: 10),
        ],
      ),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(32),
        child: BackdropFilter(
          filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
          child: Form(
            key: _formKey,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                _buildCyberTile("Origin Node", _originController, Icons.hub_outlined),
                const SizedBox(height: 20),
                _buildCyberTile("Target Node", _destinationController, Icons.gps_fixed),
                const SizedBox(height: 20),
                _buildCyberTile("Mass (Quantum KG)", _weightController, Icons.layers_outlined, isNumber: true),
                const SizedBox(height: 40),
                _buildExecuteButton(),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildCyberTile(String label, TextEditingController controller, IconData icon, {bool isNumber = false}) {
    return TextFormField(
      controller: controller,
      keyboardType: isNumber ? TextInputType.number : TextInputType.text,
      style: const TextStyle(color: Colors.white, fontSize: 18, fontFamily: 'Outfit'),
      decoration: InputDecoration(
        labelText: label.toUpperCase(),
        labelStyle: const TextStyle(color: Color(0xFFFFD700), fontSize: 10, letterSpacing: 2),
        prefixIcon: Icon(icon, color: const Color(0xFFFFD700), size: 20),
        filled: true,
        fillColor: Colors.white.withOpacity(0.05),
        border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
        focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: const BorderSide(color: Color(0xFFFFD700), width: 0.5)),
      ),
      validator: (v) => ValidationUtils.validateRequired(v, label),
    );
  }

  Widget _buildExecuteButton() {
    return Container(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(color: const Color(0xFFFFD700).withOpacity(0.2), blurRadius: 20, spreadRadius: -5),
        ],
      ),
      child: ElevatedButton(
        onPressed: _isLoading ? null : _calculateRates,
        style: ElevatedButton.styleFrom(
          backgroundColor: const Color(0xFFFFD700),
          foregroundColor: const Color(0xFF001540),
          padding: const EdgeInsets.symmetric(vertical: 20),
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
          elevation: 0,
        ),
        child: const Text("INITIALIZE QUOTE COLLAPSE", style: TextStyle(fontWeight: FontWeight.bold, letterSpacing: 2)),
      ),
    );
  }

  Widget _buildQuantumProcessor() {
    return const Column(
      children: [
        SizedBox(height: 40),
        CircularProgressIndicator(color: Color(0xFFFFD700), strokeWidth: 1),
        SizedBox(height: 20),
        Text("DECRPYTING FREIGHT PROBABILITIES...", 
          style: TextStyle(color: Color(0xFFFFD700), fontSize: 10, letterSpacing: 4, fontWeight: FontWeight.bold)),
      ],
    );
  }

  Widget _buildResultChamber() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.stretch,
      children: [
        const Text("COLLAPSED FREIGHT STATES", 
          textAlign: TextAlign.center,
          style: TextStyle(color: Colors.white30, fontSize: 10, letterSpacing: 2, fontWeight: FontWeight.bold)),
        const SizedBox(height: 20),
        ...(_rates ?? []).map((rate) => _QuantumResultCard(rate: rate)),
      ],
    );
  }
}

class _QuantumFieldPainter extends CustomPainter {
  final double progress;
  _QuantumFieldPainter(this.progress);

  @override
  void paint(Canvas canvas, Size size) {
    final paint = Paint()
      ..color = const Color(0xFFFFD700).withOpacity(0.05)
      ..style = PaintingStyle.stroke
      ..strokeWidth = 0.5;

    for (var i = 0; i < 10; i++) {
      final r = (size.width * 0.8) * (i / 10 + progress) % (size.width * 0.8);
      canvas.drawCircle(Offset(size.width / 2, size.height / 3), r, paint);
    }
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => true;
}

class _QuantumResultCard extends StatelessWidget {
  final ShippingRate rate;
  const _QuantumResultCard({required this.rate});

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(bottom: 16),
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.03),
        borderRadius: BorderRadius.circular(24),
        border: Border.all(color: Colors.white10),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(rate.serviceName.toUpperCase(), 
                style: const TextStyle(color: Color(0xFFFFD700), fontSize: 14, fontWeight: FontWeight.bold, letterSpacing: 1.2)),
              const SizedBox(height: 4),
              Row(
                children: [
                  const Icon(Icons.timer_outlined, color: Colors.white38, size: 12),
                  const SizedBox(width: 4),
                  const Text("ETA: ", style: TextStyle(color: Colors.white38, fontSize: 12)),
                  Text(rate.estimatedDays, style: const TextStyle(color: Colors.white38, fontSize: 12)),
                ],
              ),
            ],
          ),
          Column(
            crossAxisAlignment: CrossAxisAlignment.end,
            children: [
              Text("${rate.currency} ${rate.price.toStringAsFixed(2)}", 
                style: const TextStyle(color: Colors.white, fontSize: 22, fontWeight: FontWeight.bold, fontFamily: 'Outfit')),
              const Text("GLOBAL CREDIT", style: TextStyle(color: Colors.white24, fontSize: 8, fontWeight: FontWeight.bold)),
            ],
          ),
        ],
      ),
    );
  }
}
