import 'dart:math' as math;
import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/marketplace/presentation/providers/ai_sourcing_provider.dart';

class AiSourcingScreen extends ConsumerStatefulWidget {
  const AiSourcingScreen({super.key});

  @override
  ConsumerState<AiSourcingScreen> createState() => _AiSourcingScreenState();
}

class _AiSourcingScreenState extends ConsumerState<AiSourcingScreen> with TickerProviderStateMixin {
  late AnimationController _neuralController;
  final _controller = TextEditingController();
  final ScrollController _scrollController = ScrollController();

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
    
    final text = _controller.text.trim();
    _controller.clear();
    ref.read(aiSourcingProvider.notifier).sendMessage(text);
    _scrollToBottom();
  }

  void _scrollToBottom() {
    Future.delayed(const Duration(milliseconds: 300), () {
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
    final aiState = ref.watch(aiSourcingProvider);
    
    // Auto-scroll on new message
    ref.listen(aiSourcingProvider, (previous, next) {
      if (previous?.messages.length != next.messages.length) {
        _scrollToBottom();
      }
    });

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
                  itemCount: aiState.messages.length,
                  itemBuilder: (context, index) {
                    final msg = aiState.messages[index];
                    return _buildNeuralBubble(msg);
                  },
                ),
              ),
              if (aiState.isLoading) _buildScanningIndicator(),
              if (aiState.error != null) _buildErrorIndicator(aiState.error!),
              _buildInputMatrix(aiState.isLoading),
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
              Text('SOURCING ASSISTANT v1.1', 
                style: TextStyle(color: Color(0xFFFFD700), fontSize: 10, letterSpacing: 3, fontWeight: FontWeight.bold)),
              Text('Live Procurement Node', 
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
        if (isAi && (msg['hasAction'] == true || msg['suggestions'] != null)) ...[
          Padding(
            padding: const EdgeInsets.only(bottom: 24, left: 8),
            child: Wrap(
               spacing: 12,
               runSpacing: 12,
               children: [
                  if (msg['suggestions'] != null)
                    for (var sug in (msg['suggestions'] as List))
                      _buildNodeAction(sug.toString().toUpperCase(), Icons.bolt, isSecondary: true, onTap: () {
                        _controller.text = sug.toString();
                        _sendMessage();
                      }),
                  if (msg['hasAction'] == true)
                    _buildNodeAction("VIEW MATCHES", Icons.grid_view),
               ],
            ),
          ),
        ]
      ],
    );
  }

  Widget _buildNodeAction(String label, IconData icon, {bool isSecondary = false, VoidCallback? onTap}) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
        decoration: BoxDecoration(
          color: isSecondary ? Colors.transparent : const Color(0xFFFFD700),
          borderRadius: BorderRadius.circular(12),
          border: isSecondary ? Border.all(color: const Color(0xFFFFD700).withOpacity(0.5)) : null,
        ),
        child: Row(
          mainAxisSize: MainAxisSize.min,
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
          Text("QUERYING SOURCING NODE...", 
            style: TextStyle(color: const Color(0xFFFFD700).withOpacity(0.6), fontSize: 10, letterSpacing: 2, fontWeight: FontWeight.bold)),
        ],
      ),
    );
  }

  Widget _buildErrorIndicator(String error) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 8),
      child: Text(error, 
        style: const TextStyle(color: Colors.redAccent, fontSize: 10, fontWeight: FontWeight.bold)),
    );
  }

  Widget _buildInputMatrix(bool isLoading) {
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
                    enabled: !isLoading,
                    style: const TextStyle(color: Colors.white, fontSize: 14),
                    decoration: InputDecoration(
                      hintText: isLoading ? 'Syncing...' : 'What are you looking for?',
                      hintStyle: TextStyle(color: Colors.white.withOpacity(0.2), fontSize: 14),
                      border: InputBorder.none,
                    ),
                    onSubmitted: (_) => _sendMessage(),
                  ),
                ),
              ),
              const SizedBox(width: 16),
              GestureDetector(
                onTap: isLoading ? null : _sendMessage,
                child: Container(
                  width: 52,
                  height: 52,
                  decoration: BoxDecoration(
                    color: isLoading ? Colors.grey : const Color(0xFFFFD700),
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
