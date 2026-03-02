import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/support/data/repositories/support_repository.dart';
import 'package:mobile/features/support/data/models/support_model.dart';

class TicketDetailScreen extends ConsumerStatefulWidget {
  final int ticketId;
  const TicketDetailScreen({super.key, required this.ticketId});

  @override
  ConsumerState<TicketDetailScreen> createState() => _TicketDetailScreenState();
}

class _TicketDetailScreenState extends ConsumerState<TicketDetailScreen> {
  final _messageController = TextEditingController();
  bool _sending = false;

  @override
  void dispose() {
    _messageController.dispose();
    super.dispose();
  }

  Future<void> _sendReply() async {
    if (_messageController.text.trim().isEmpty) return;
    
    setState(() => _sending = true);
    try {
      await ref.read(supportRepositoryProvider).replyToTicket(widget.ticketId, _messageController.text.trim());
      _messageController.clear();
      ref.invalidate(ticketDetailsProvider(widget.ticketId));
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text('Error: $e')));
    } finally {
      if (mounted) setState(() => _sending = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    final ticketAsync = ref.watch(ticketDetailsProvider(widget.ticketId));

    return Scaffold(
      appBar: AppBar(title: const Text('Ticket Details')),
      body: ticketAsync.when(
        data: (ticket) => Column(
          children: [
            Expanded(
              child: ListView.builder(
                padding: const EdgeInsets.all(16),
                itemCount: ticket.messages.length + 1,
                itemBuilder: (context, index) {
                  if (index == 0) {
                    return _buildHeader(ticket);
                  }
                  final message = ticket.messages[index - 1];
                  return _buildMessageBubble(message);
                },
              ),
            ),
            if (ticket.status.toLowerCase() != 'closed') _buildInputArea(),
          ],
        ),
        loading: () => const Center(child: CircularProgressIndicator()),
        error: (err, stack) => Center(child: Text('Error: $err')),
      ),
    );
  }

  Widget _buildHeader(SupportTicket ticket) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(ticket.subject, style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold)),
        const SizedBox(height: 8),
        Row(
          children: [
            Chip(label: Text(ticket.category, style: const TextStyle(fontSize: 12))),
            const SizedBox(width: 8),
            Chip(label: Text(ticket.priority.toUpperCase(), style: const TextStyle(fontSize: 12))),
          ],
        ),
        const Divider(height: 32),
      ],
    );
  }

  Widget _buildMessageBubble(SupportMessage message) {
    final isAdmin = message.isAdmin;
    return Container(
      margin: const EdgeInsets.only(bottom: 16),
      alignment: isAdmin ? Alignment.centerLeft : Alignment.centerRight,
      child: Container(
        padding: const EdgeInsets.all(12),
        constraints: BoxConstraints(maxWidth: MediaQuery.of(context).size.width * 0.75),
        decoration: BoxDecoration(
          color: isAdmin ? Colors.grey[200] : Colors.blue[600],
          borderRadius: BorderRadius.circular(16).copyWith(
            bottomLeft: isAdmin ? const Radius.circular(0) : const Radius.circular(16),
            bottomRight: isAdmin ? const Radius.circular(16) : const Radius.circular(0),
          ),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            if (isAdmin) Text(message.userName ?? 'Support Agent', style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 10, color: Colors.blueGrey)),
            Text(message.message, style: TextStyle(color: isAdmin ? Colors.black : Colors.white)),
            const SizedBox(height: 4),
            Text('${message.createdAt.hour}:${message.createdAt.minute.toString().padLeft(2, '0')}', 
                style: TextStyle(fontSize: 9, color: isAdmin ? Colors.grey[600] : Colors.white70)),
          ],
        ),
      ),
    );
  }

  Widget _buildInputArea() {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(color: Colors.white, boxShadow: [BoxShadow(color: Colors.black12, blurRadius: 4)]),
      child: Row(
        children: [
          Expanded(
            child: TextField(
              controller: _messageController,
              decoration: const InputDecoration(hintText: 'Type a message...', border: OutlineInputBorder()),
              maxLines: null,
            ),
          ),
          const SizedBox(width: 8),
          IconButton(
            onPressed: _sending ? null : _sendReply,
            icon: _sending ? const CircularProgressIndicator() : const Icon(Icons.send, color: Colors.blue),
          ),
        ],
      ),
    );
  }
}
