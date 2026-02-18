import 'package:flutter/material.dart';

class AiSourcingScreen extends StatefulWidget {
  const AiSourcingScreen({super.key});

  @override
  State<AiSourcingScreen> createState() => _AiSourcingScreenState();
}

class _AiSourcingScreenState extends State<AiSourcingScreen> {
  final List<Map<String, dynamic>> _messages = [
    {
      'isAi': true,
      'text': 'Hello! I am your GlobalLine Sourcing Assistant. What item would you like to procure from China, USA, or Europe today?',
    }
  ];
  final _controller = TextEditingController();
  bool _isTyping = false;

  void _sendMessage() {
    if (_controller.text.trim().isEmpty) return;

    setState(() {
      _messages.add({'isAi': false, 'text': _controller.text.trim()});
      _isTyping = true;
    });

    final input = _controller.text.toLowerCase();
    _controller.clear();

    // Simulated AI Response logic
    Future.delayed(const Duration(seconds: 2), () {
      String response = "I've started searching my verified supplier database for those items. Would you like a quote for Air or Sea shipping?";
      if (input.contains('iphone') || input.contains('phone') || input.contains('laptop')) {
        response = "Great choice! I have 15+ verified electronics suppliers in Shenzhen. Typical lead time is 3 days to our warehouse. Should I request a bulk quote for you?";
      } else if (input.contains('shoe') || input.contains('cloth')) {
        response = "I can find high-quality fashion manufacturers for you. I'll need your target quantity to get the best wholesale price. How many are you looking to source?";
      }

      if (mounted) {
        setState(() {
          _isTyping = false;
          _messages.add({'isAi': true, 'text': response});
        });
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF8FAFC),
      appBar: AppBar(
        title: Row(
          children: [
            const CircleAvatar(
              backgroundColor: Color(0xFF002366),
              child: Icon(Icons.auto_awesome, color: Colors.white, size: 20),
            ),
            const SizedBox(width: 12),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const Text('AI Sourcing Agent', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
                Text('Always Online', style: TextStyle(fontSize: 10, color: Colors.green[700])),
              ],
            ),
          ],
        ),
        actions: [
          IconButton(icon: const Icon(Icons.info_outline), onPressed: () {}),
        ],
      ),
      body: Column(
        children: [
          Expanded(
            child: ListView.builder(
              padding: const EdgeInsets.all(20),
              itemCount: _messages.length,
              itemBuilder: (context, index) {
                final msg = _messages[index];
                return _buildMessageBubble(msg['text'], msg['isAi']);
              },
            ),
          ),
          if (_isTyping)
            Padding(
              padding: const EdgeInsets.only(left: 20, bottom: 10),
              child: Row(
                children: [
                  Text('AI is searching suppliers...', style: TextStyle(color: Colors.grey[600], fontSize: 12, fontStyle: FontStyle.italic)),
                ],
              ),
            ),
          _buildInputArea(),
        ],
      ),
    );
  }

  Widget _buildMessageBubble(String text, bool isAi) {
    return Align(
      alignment: isAi ? Alignment.centerLeft : Alignment.centerRight,
      child: Container(
        margin: const EdgeInsets.only(bottom: 16),
        padding: const EdgeInsets.all(16),
        constraints: BoxConstraints(maxWidth: MediaQuery.of(context).size.width * 0.75),
        decoration: BoxDecoration(
          color: isAi ? Colors.white : const Color(0xFF002366),
          borderRadius: BorderRadius.circular(20).copyWith(
            bottomLeft: isAi ? const Radius.circular(0) : const Radius.circular(20),
            bottomRight: isAi ? const Radius.circular(20) : const Radius.circular(0),
          ),
          boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10, offset: const Offset(0, 5))],
        ),
        child: Text(text, style: TextStyle(color: isAi ? Colors.black87 : Colors.white, fontSize: 14, height: 1.5)),
      ),
    );
  }

  Widget _buildInputArea() {
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white,
        boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10, offset: const Offset(0, -5))],
      ),
      child: Row(
        children: [
          Expanded(
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 16),
              decoration: BoxDecoration(color: Colors.grey[100], borderRadius: BorderRadius.circular(30)),
              child: TextField(
                controller: _controller,
                decoration: const InputDecoration(hintText: 'Describe what you want to find...', border: InputBorder.none),
                onSubmitted: (_) => _sendMessage(),
              ),
            ),
          ),
          const SizedBox(width: 12),
          CircleAvatar(
            backgroundColor: const Color(0xFF002366),
            child: IconButton(icon: const Icon(Icons.send, color: Colors.white, size: 20), onPressed: _sendMessage),
          ),
        ],
      ),
    );
  }
}
