import 'dart:math' as math;
import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';

class AiSourcingScreen extends StatefulWidget {
  const AiSourcingScreen({super.key});

  @override
  State<AiSourcingScreen> createState() => _AiSourcingScreenState();
}

class _AiSourcingScreenState extends State<AiSourcingScreen> with TickerProviderStateMixin {
  late AnimationController _neuralController;
  final List<Map<String, dynamic>> _messages = [
    {
      'isAi': true,
      'text': 'NEURAL LINK ESTABLISHED. I am your GlobalLine Sourcing Agent. I have active pipelines to Shenzhen, Istanbul, and Dubai. What procurement node shall we activate today?',
    }
  ];
  final _controller = TextEditingController();
  final ScrollController _scrollController = ScrollController();
  bool _isTyping = false;

  @override
  void initState() {
    super.initState();
    _neuralController = AnimationController(
      duration: const Duration(seconds: 4),
      vsync: this,
    )..repeat();
  }

  @override
  void dispose() {
    _neuralController.dispose();
    _scrollController.dispose();
    _controller.dispose();
    super.dispose();
  }

  void _sendMessage() {
    if (_controller.text.trim().isEmpty) return;

    setState(() {
      _messages.add({'isAi': false, 'text': _controller.text.trim()});
      _isTyping = true;
    });

    final input = _controller.text.toLowerCase();
    _controller.clear();
    _scrollToBottom();

    // Neural Processing Simulation
    Future.delayed(const Duration(seconds: 2), () {
      String response = "SUPPLIER NODES SCANNED. I've found 4 potential high-fidelity matches for your request. Initial verification suggests we can achieve a 12% margin below market average. Should I finalize the RFQ parameters?";
      
      if (input.contains('iphone') || input.contains('phone') || input.contains('laptop')) {
        response = "ELECTRONICS GRID ACCESSED. 22 verified manufacturers in Shenzhen are active. One factory has a surplus of A-Grade components ready for immediate dispatch. Shall we bridge to an official RFQ?";
      } else if (input.contains('shoe') || input.contains('cloth')) {
        response = "TEXTILE AGGREGATOR SYNCED. Turkey and China nodes show optimal price-to-quality ratios for this quantity. I suggest the Turkey node for faster lead times. Confirm target MOQ?";
      }

      if (mounted) {
        setState(() {
          _isTyping = false;
          _messages.add({
            'isAi': true, 
            'text': response,
            'hasAction': true,
          });
        });
        _scrollToBottom();
      }
    });
  }

  void _scrollToBottom() {
    Future.delayed(const Duration(milliseconds: 100), () {
      if (_scrollController.hasClients) {
        _scrollController.animateTo(
          _scrollController.position.maxScrollExtent,
          duration: const Duration(milliseconds: 300),
          curve: Curves.easeOut,
        );
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF001540), // GlobalLine Deep Navy
      body: Stack(
        children: [
          // 1. Neural Field Background
          Positioned.fill(
            child: AnimatedBuilder(
              animation: _neuralController,
              builder: (context, child) {
                return CustomPaint(
                  painter: _NeuralLinkPainter(_neuralController.value),
                );
              },
            ),
          ),

          // 2. Chat Interface
          Column(
            children: [
              _buildHeader(),
              Expanded(
                child: ListView.builder(
                  controller: _scrollController,
                  padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 32),
                  itemCount: _messages.length,
                  itemBuilder: (context, index) {
                    final msg = _messages[index];
                    return _buildNeuralBubble(msg);
                  },
                ),
              ),
              if (_isTyping) _buildScanningIndicator(),
              _buildInputMatrix(),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildHeader() {
    return Container(
      padding: const EdgeInsets.fromLTRB(24, 60, 24, 20),
      decoration: BoxDecoration(
        color: Colors.black.withOpacity(0.4),
        border: Border(bottom: BorderSide(color: const Color(0xFFFFD700).withOpacity(0.1))),
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(10),
            decoration: BoxDecoration(
              color: const Color(0xFFFFD700).withOpacity(0.1),
              shape: BoxShape.circle,
              border: Border.all(color: const Color(0xFFFFD700).withOpacity(0.2)),
            ),
            child: const Icon(Icons.auto_awesome, color: Color(0xFFFFD700), size: 20),
          ),
          const SizedBox(width: 16),
          const Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text('NEURAL AGENT v1.0', 
                style: TextStyle(color: Color(0xFFFFD700), fontSize: 10, letterSpacing: 3, fontWeight: FontWeight.bold)),
              Text('Syncing Global Nodes...', 
                style: TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold, fontFamily: 'Outfit')),
            ],
          ),
          const Spacer(),
          IconButton(
            onPressed: () => Navigator.pop(context),
            icon: const Icon(Icons.close, color: Colors.white70),
          ),
        ],
      ),
    );
  }

  Widget _buildNeuralBubble(Map<String, dynamic> msg) {
    bool isAi = msg['isAi'] ?? false;
    return Column(
      crossAxisAlignment: isAi ? CrossAxisAlignment.start : CrossAxisAlignment.end,
      children: [
        Align(
          alignment: isAi ? Alignment.centerLeft : Alignment.centerRight,
          child: Container(
            margin: const EdgeInsets.only(bottom: 24),
            padding: const EdgeInsets.all(20),
            constraints: BoxConstraints(maxWidth: MediaQuery.of(context).size.width * 0.8),
            decoration: BoxDecoration(
              color: isAi ? Colors.white.withOpacity(0.05) : const Color(0xFFFFD700).withOpacity(0.1),
              borderRadius: BorderRadius.circular(24).copyWith(
                bottomLeft: isAi ? const Radius.circular(4) : const Radius.circular(24),
                bottomRight: isAi ? const Radius.circular(24) : const Radius.circular(4),
              ),
              border: Border.all(
                color: isAi ? Colors.white.withOpacity(0.1) : const Color(0xFFFFD700).withOpacity(0.3),
              ),
            ),
            child: Text(
              msg['text'], 
              style: TextStyle(
                color: isAi ? Colors.white.withOpacity(0.9) : const Color(0xFFFFD700), 
                fontSize: 14, 
                height: 1.6,
                fontFamily: 'Outfit'
              )
            ),
          ),
        ),
        if (isAi && msg['hasAction'] == true) ...[
          Padding(
            padding: const EdgeInsets.only(bottom: 24, left: 8),
            child: Row(
              children: [
                _buildNodeAction("FINALIZE RFQ", Icons.assignment_turned_in),
                const SizedBox(width: 12),
                _buildNodeAction("SCAN TURKEY", Icons.gps_fixed, isSecondary: true),
              ],
            ),
          ),
        ]
      ],
    );
  }

  Widget _buildNodeAction(String label, IconData icon, {bool isSecondary = false}) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
      decoration: BoxDecoration(
        color: isSecondary ? Colors.transparent : const Color(0xFFFFD700),
        borderRadius: BorderRadius.circular(12),
        border: isSecondary ? Border.all(color: const Color(0xFFFFD700).withOpacity(0.5)) : null,
      ),
      child: Row(
        children: [
          Icon(icon, size: 14, color: isSecondary ? const Color(0xFFFFD700) : const Color(0xFF001540)),
          const SizedBox(width: 8),
          Text(label, style: TextStyle(
            color: isSecondary ? const Color(0xFFFFD700) : const Color(0xFF001540), 
            fontWeight: FontWeight.bold, 
            fontSize: 10,
            letterSpacing: 1,
          )),
        ],
      ),
    );
  }

  Widget _buildScanningIndicator() {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 8),
      child: Row(
        children: [
          const SizedBox(
            width: 12,
            height: 12,
            child: CircularProgressIndicator(strokeWidth: 1, color: Color(0xFFFFD700)),
          ),
          const SizedBox(width: 12),
          Text("DECRYPTING SUPPLIER FREQUENCIES...", 
            style: TextStyle(color: const Color(0xFFFFD700).withOpacity(0.6), fontSize: 10, letterSpacing: 2, fontWeight: FontWeight.bold)),
        ],
      ),
    );
  }

  Widget _buildInputMatrix() {
    return ClipRRect(
      child: BackdropFilter(
        filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
        child: Container(
          padding: EdgeInsets.fromLTRB(24, 20, 24, MediaQuery.of(context).padding.bottom + 20),
          decoration: BoxDecoration(
            color: Colors.black.withOpacity(0.4),
            border: Border(top: BorderSide(color: Colors.white.withOpacity(0.05))),
          ),
          child: Row(
            children: [
              Expanded(
                child: Container(
                  padding: const EdgeInsets.symmetric(horizontal: 20),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.03),
                    borderRadius: BorderRadius.circular(16),
                    border: Border.all(color: Colors.white.withOpacity(0.1)),
                  ),
                  child: TextField(
                    controller: _controller,
                    style: const TextStyle(color: Colors.white, fontSize: 14),
                    decoration: InputDecoration(
                      hintText: 'Transmit procurement intent...',
                      hintStyle: TextStyle(color: Colors.white.withOpacity(0.2), fontSize: 14),
                      border: InputBorder.none,
                    ),
                    onSubmitted: (_) => _sendMessage(),
                  ),
                ),
              ),
              const SizedBox(width: 16),
              GestureDetector(
                onTap: _sendMessage,
                child: Container(
                  width: 52,
                  height: 52,
                  decoration: BoxDecoration(
                    color: const Color(0xFFFFD700),
                    borderRadius: BorderRadius.circular(16),
                    boxShadow: [
                      BoxShadow(color: const Color(0xFFFFD700).withOpacity(0.3), blurRadius: 20, spreadRadius: -5),
                    ],
                  ),
                  child: const Icon(Icons.flash_on, color: Color(0xFF001540)),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class _NeuralLinkPainter extends CustomPainter {
  final double progress;
  _NeuralLinkPainter(this.progress);

  @override
  void paint(Canvas canvas, Size size) {
    final paint = Paint()
      ..style = PaintingStyle.stroke
      ..strokeWidth = 0.5;

    final random = math.Random(1337);
    for (var i = 0; i < 15; i++) {
      paint.color = const Color(0xFFFFD700).withOpacity(0.05 + (0.05 * math.sin(progress * 2 * math.pi + i)));
      
      final startX = size.width * random.nextDouble();
      final startY = size.height * random.nextDouble();
      final endX = size.width * random.nextDouble();
      final endY = size.height * random.nextDouble();

      final p1 = Offset(startX, startY);
      final p2 = Offset(endX, endY);
      
      canvas.drawLine(p1, p2, paint);
      
      // Draw node particles
      paint.style = PaintingStyle.fill;
      canvas.drawCircle(p1, 1.5, paint);
      paint.style = PaintingStyle.stroke;
    }
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => true;
}
