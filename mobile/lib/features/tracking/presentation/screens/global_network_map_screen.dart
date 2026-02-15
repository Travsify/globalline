import 'package:flutter/material.dart';
import 'dart:math' as math;

class GlobalNetworkMapScreen extends StatefulWidget {
  const GlobalNetworkMapScreen({super.key});

  @override
  State<GlobalNetworkMapScreen> createState() => _GlobalNetworkMapScreenState();
}

class _GlobalNetworkMapScreenState extends State<GlobalNetworkMapScreen> with SingleTickerProviderStateMixin {
  late AnimationController _controller;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(vsync: this, duration: const Duration(seconds: 10))..repeat();
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF0F172A),
      appBar: AppBar(
        title: const Text('Live Network Map', style: TextStyle(color: Colors.white)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        iconTheme: const IconThemeData(color: Colors.white),
      ),
      body: Stack(
        children: [
          Center(
            child: AnimatedBuilder(
              animation: _controller,
              builder: (context, child) {
                return CustomPaint(
                  painter: NetworkMapPainter(_controller.value),
                  size: Size(MediaQuery.of(context).size.width, MediaQuery.of(context).size.height * 0.7),
                );
              },
            ),
          ),
          Positioned(
            bottom: 40,
            left: 20,
            right: 20,
            child: Container(
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: Colors.white.withOpacity(0.05),
                borderRadius: BorderRadius.circular(20),
                border: Border.all(color: Colors.white.withOpacity(0.1)),
              ),
              child: Column(
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      _buildStat('Active Flights', '12'),
                      _buildStat('Sea Cargo', '4'),
                      _buildStat('Warehouse', '28'),
                    ],
                  ),
                  const SizedBox(height: 16),
                  const Text('Real-time global logistics visualization', style: TextStyle(color: Colors.white54, fontSize: 12)),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildStat(String label, String value) {
    return Column(
      children: [
        Text(value, style: const TextStyle(color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold)),
        Text(label, style: const TextStyle(color: Colors.white54, fontSize: 10)),
      ],
    );
  }
}

class NetworkMapPainter extends CustomPainter {
  final double progress;
  NetworkMapPainter(this.progress);

  @override
  void paint(Canvas canvas, Size size) {
    final paint = Paint()
      ..color = Colors.blue.withOpacity(0.1)
      ..style = PaintingStyle.fill;

    // Draw stylized "Grid" or dots for world map
    final dotPaint = Paint()..color = Colors.white.withOpacity(0.05);
    for (double i = 0; i < size.width; i += 20) {
      for (double j = 0; j < size.height; j += 20) {
        // Randomly skip to create map gaps
        if (math.Random((i + j).toInt()).nextDouble() > 0.4) {
           canvas.drawCircle(Offset(i, j), 1, dotPaint);
        }
      }
    }

    // Hubs (Lagos, Guangzhou, Dubai, New York)
    final hubs = [
      Offset(size.width * 0.45, size.height * 0.6), // Lagos
      Offset(size.width * 0.8, size.height * 0.45), // Guangzhou
      Offset(size.width * 0.6, size.height * 0.45),  // Dubai
      Offset(size.width * 0.2, size.height * 0.4),   // New York
    ];

    final hubPaint = Paint()..color = Colors.blue;
    final pulsePaint = Paint()..color = Colors.blue.withOpacity(0.3 * (1 - (progress % 0.25) * 4));

    for (var hub in hubs) {
      canvas.drawCircle(hub, 4, hubPaint);
      canvas.drawCircle(hub, 8 + (progress % 0.25) * 40, pulsePaint);
    }

    // Animated Flight paths
    _drawPath(canvas, hubs[1], hubs[0], progress, Colors.cyan); // GZ -> LOS
    _drawPath(canvas, hubs[2], hubs[0], (progress + 0.3) % 1.0, Colors.blueAccent); // DBX -> LOS
    _drawPath(canvas, hubs[1], hubs[2], (progress + 0.6) % 1.0, Colors.orangeAccent); // GZ -> DBX
    _drawPath(canvas, hubs[3], hubs[0], (progress + 0.1) % 1.0, Colors.purpleAccent); // NY -> LOS
  }

  void _drawPath(Canvas canvas, Offset start, Offset end, double t, Color color) {
    final path = Path();
    path.moveTo(start.dx, start.dy);
    
    // Curved line (Quadratic Bezier)
    final controlPoint = Offset((start.dx + end.dx) / 2, math.min(start.dy, end.dy) - 100);
    path.quadraticBezierTo(controlPoint.dx, controlPoint.dy, end.dx, end.dy);

    final linePaint = Paint()
      ..color = color.withOpacity(0.2)
      ..style = PaintingStyle.stroke
      ..strokeWidth = 1;
    
    canvas.drawPath(path, linePaint);

    // Moving "Plane" dot
    final pathMetrics = path.computeMetrics();
    for (var metric in pathMetrics) {
      final pos = metric.getTangentForOffset(metric.length * t)?.position;
      if (pos != null) {
        final glowPaint = Paint()..color = color.withOpacity(0.8)..maskFilter = const MaskFilter.blur(BlurStyle.normal, 4);
        canvas.drawCircle(pos, 4, glowPaint);
        canvas.drawCircle(pos, 2, Paint()..color = Colors.white);
      }
    }
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => true;
}
