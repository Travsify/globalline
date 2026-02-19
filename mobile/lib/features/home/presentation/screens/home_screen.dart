import 'dart:math' as math;
import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/auth/presentation/providers/auth_provider.dart';

class HomeScreen extends ConsumerStatefulWidget {
  const HomeScreen({super.key});

  @override
  ConsumerState<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends ConsumerState<HomeScreen> with TickerProviderStateMixin {
  late AnimationController _pulseController;
  late AnimationController _gridController;

  @override
  void initState() {
    super.initState();
    _pulseController = AnimationController(
      duration: const Duration(seconds: 10),
      vsync: this,
    )..repeat();

    _gridController = AnimationController(
      duration: const Duration(milliseconds: 1500),
      vsync: this,
    );

    Future.delayed(const Duration(milliseconds: 300), () {
      if (mounted) _gridController.forward();
    });
  }

  @override
  void dispose() {
    _pulseController.dispose();
    _gridController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF001540), // GlobalLine Deep Navy
      body: Stack(
        children: [
          // 1. The Pulse: Generative Flow Background
          Positioned.fill(
            child: AnimatedBuilder(
              animation: _pulseController,
              builder: (context, child) {
                return CustomPaint(
                  painter: _PulseFlowPainter(_pulseController.value),
                );
              },
            ),
          ),

          // 2. Glassmorphism Content Layer
          SafeArea(
            child: CustomScrollView(
              physics: const BouncingScrollPhysics(),
              slivers: [
                _buildDynamicHeader(),
                _buildPrioritySurgeCard(),
                _buildBentoServiceGrid(),
                const SliverToBoxAdapter(child: SizedBox(height: 120)),
              ],
            ),
          ),

          // 3. The Universal Action Node
          _buildUniversalActionNode(),
        ],
      ),
    );
  }

  Widget _buildDynamicHeader() {
    return SliverPadding(
      padding: const EdgeInsets.all(24.0),
      sliver: SliverToBoxAdapter(
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const Text("THE PULSE", 
                  style: TextStyle(color: Color(0xFFFFD700), 
                  fontSize: 10, letterSpacing: 4, fontWeight: FontWeight.bold)),
                const SizedBox(height: 4),
                const Text("Welcome, Alexander", 
                  style: TextStyle(color: Colors.white, fontSize: 24, fontWeight: FontWeight.bold, fontFamily: 'Outfit')),
              ],
            ),
            _buildNotificationNode(),
          ],
        ),
      ),
    );
  }

  Widget _buildNotificationNode() {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        shape: BoxShape.circle,
        border: Border.all(color: Colors.white10),
      ),
      child: IconButton(
        onPressed: () => context.push('/notifications'),
        icon: const Icon(Icons.blur_on_rounded, color: Color(0xFFFFD700), size: 28),
      ),
    );
  }

  Widget _buildPrioritySurgeCard() {
    return SliverToBoxAdapter(
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 24.0, vertical: 8),
        child: ClipRRect(
          borderRadius: BorderRadius.circular(32),
          child: BackdropFilter(
            filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
            child: Container(
              padding: const EdgeInsets.all(32),
              decoration: BoxDecoration(
                color: Colors.white.withOpacity(0.03),
                borderRadius: BorderRadius.circular(32),
                border: Border.all(color: Colors.white.withOpacity(0.1)),
                gradient: LinearGradient(
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                  colors: [Colors.white.withOpacity(0.05), Colors.transparent],
                ),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      const Text("\$82,450.00", 
                        style: TextStyle(color: Colors.white, fontSize: 36, fontWeight: FontWeight.w900, fontFamily: 'Outfit')),
                      Container(
                        padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                        decoration: BoxDecoration(color: const Color(0xFFFFD700).withOpacity(0.1), borderRadius: BorderRadius.circular(20)),
                        child: const Row(
                          children: [
                            Icon(Icons.trending_up, color: Color(0xFFFFD700), size: 12),
                            SizedBox(width: 4),
                            Text("2.4%", style: TextStyle(color: Color(0xFFFFD700), fontSize: 10, fontWeight: FontWeight.bold)),
                          ],
                        ),
                      ),
                    ],
                  ),
                  const Text("CURRENT LIQUIDITY", 
                    style: TextStyle(color: Colors.white30, fontSize: 10, letterSpacing: 2, fontWeight: FontWeight.bold)),
                  const SizedBox(height: 32),
                  Row(
                    children: [
                      _buildQuickAction(Icons.add_circle_outline, "Top Up", const Color(0xFFFFD700)),
                      const SizedBox(width: 24),
                      _buildQuickAction(Icons.send_outlined, "Transfer", Colors.white),
                      const SizedBox(width: 24),
                      _buildQuickAction(Icons.qr_code_scanner, "Scan", Colors.white),
                    ],
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildQuickAction(IconData icon, String label, Color color) {
    return Column(
      children: [
        Container(
          padding: const EdgeInsets.all(12),
          decoration: BoxDecoration(
            color: color.withOpacity(0.05),
            shape: BoxShape.circle,
            border: Border.all(color: color.withOpacity(0.1)),
          ),
          child: Icon(icon, color: color, size: 20),
        ),
        const SizedBox(height: 8),
        Text(label, style: TextStyle(color: color.withOpacity(0.6), fontSize: 10, fontWeight: FontWeight.bold)),
      ],
    );
  }

  Widget _buildBentoServiceGrid() {
    return SliverPadding(
      padding: const EdgeInsets.all(24),
      sliver: SliverGrid.count(
        crossAxisCount: 2,
        mainAxisSpacing: 16,
        crossAxisSpacing: 16,
        childAspectRatio: 1.1,
        children: [
          _BentoCard(
            title: "Ship For Me",
            subtitle: "Global Procurement",
            icon: Icons.shopping_bag_outlined,
            color: const Color(0xFFFFD700),
            onTap: () => context.push('/ship/for-me'),
          ),
          _BentoCard(
            title: "Sourcing Hub",
            subtitle: "China Factories",
            icon: Icons.factory_outlined,
            color: const Color(0xFFFFD700),
            onTap: () => context.push('/sourcing'),
          ),
          _BentoCard(
            title: "The Oracle",
            subtitle: "Quantum Calculator",
            icon: Icons.blur_circular,
            color: Colors.white,
            onTap: () => context.push('/calculator'),
          ),
          _BentoCard(
            title: "Global Suite",
            subtitle: "Warehouse Nodes",
            icon: Icons.hub_outlined,
            color: Colors.white70,
            onTap: () => context.push('/logistics/virtual-addresses'),
          ),
        ],
      ),
    );
  }

  Widget _buildUniversalActionNode() {
    return Positioned(
      bottom: 40,
      left: 0,
      right: 0,
      child: Center(
        child: GestureDetector(
          onTap: () {}, // Action center logic
          child: Container(
            width: 72,
            height: 72,
            decoration: BoxDecoration(
              color: const Color(0xFFFFD700),
              shape: BoxShape.circle,
              boxShadow: [
                BoxShadow(color: const Color(0xFFFFD700).withOpacity(0.4), blurRadius: 40, spreadRadius: 10),
              ],
            ),
            child: const Icon(Icons.flash_on, color: Color(0xFF001540), size: 32),
          ),
        ),
      ),
    );
  }
}

class _BentoCard extends StatelessWidget {
  final String title;
  final String subtitle;
  final IconData icon;
  final Color color;
  final VoidCallback onTap;

  const _BentoCard({required this.title, required this.subtitle, required this.icon, required this.color, required this.onTap});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        decoration: BoxDecoration(
          color: Colors.white.withOpacity(0.04),
          borderRadius: BorderRadius.circular(24),
          border: Border.all(color: Colors.white.withOpacity(0.05)),
        ),
        padding: const EdgeInsets.all(20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Icon(icon, color: color, size: 28),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(title, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 14)),
                const SizedBox(height: 2),
                Text(subtitle, style: TextStyle(color: Colors.white.withOpacity(0.3), fontSize: 10)),
              ],
            ),
          ],
        ),
      ),
    );
  }
}

class _PulseFlowPainter extends CustomPainter {
  final double progress;
  _PulseFlowPainter(this.progress);

  @override
  void paint(Canvas canvas, Size size) {
    final paint = Paint()
      ..style = PaintingStyle.fill;

    final random = math.Random(42);
    for (var i = 0; i < 6; i++) {
      paint.color = const Color(0xFFFFD700).withOpacity(0.03);

      final x = size.width * random.nextDouble() + (math.sin(progress * math.pi * 2 + i) * 50);
      final y = size.height * random.nextDouble() + (math.cos(progress * math.pi * 2 + i) * 50);
      final radius = 100 + random.nextDouble() * 200;

      canvas.drawCircle(Offset(x, y), radius, paint);
    }

    // Secondary subtle bloom in brand Navy tone
    paint.color = const Color(0xFF002366).withOpacity(0.05);
    canvas.drawCircle(Offset(size.width / 2, size.height / 2), size.width * (0.5 + 0.1 * math.sin(progress * 2 * math.pi)), paint);
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => true;
}
