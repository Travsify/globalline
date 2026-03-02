import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/support/data/repositories/support_repository.dart';
import 'package:mobile/shared/widgets/status_widgets.dart';
import 'package:go_router/go_router.dart';

class SupportTicketListScreen extends ConsumerWidget {
  const SupportTicketListScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final ticketsAsync = ref.watch(ticketsProvider);

    return Scaffold(
      appBar: AppBar(
        title: const Text('Help & Support'),
        actions: [
          IconButton(
            icon: const Icon(Icons.add_comment),
            onPressed: () => context.push('/support/create'),
          ),
        ],
      ),
      body: ticketsAsync.when(
        data: (tickets) => tickets.isEmpty
            ? Center(
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    const Icon(Icons.support_agent, size: 64, color: Colors.grey),
                    const SizedBox(height: 16),
                    const Text('No support tickets yet', style: TextStyle(color: Colors.grey)),
                    const SizedBox(height: 16),
                    ElevatedButton(
                      onPressed: () => context.push('/support/create'),
                      child: const Text('Create Ticket'),
                    ),
                  ],
                ),
              )
            : RefreshIndicator(
                onRefresh: () async => ref.invalidate(ticketsProvider),
                child: ListView.builder(
                  padding: const EdgeInsets.all(16),
                  itemCount: tickets.length,
                  itemBuilder: (context, index) {
                    final ticket = tickets[index];
                    return Card(
                      child: ListTile(
                        onTap: () => context.push('/support/ticket/${ticket.id}'),
                        title: Text(ticket.subject, style: const TextStyle(fontWeight: FontWeight.bold)),
                        subtitle: Text('${ticket.category} • ${ticket.createdAt.day}/${ticket.createdAt.month}/${ticket.createdAt.year}'),
                        trailing: _buildStatusChip(ticket.status),
                      ),
                    );
                  },
                ),
              ),
        loading: () => const AppLoadingWidget(),
        error: (err, stack) => AppErrorWidget(
          message: err.toString(),
          onRetry: () => ref.invalidate(ticketsProvider),
        ),
      ),
    );
  }

  Widget _buildStatusChip(String status) {
    Color color;
    switch (status.toLowerCase()) {
      case 'open':
        color = Colors.blue;
        break;
      case 'in_progress':
        color = Colors.orange;
        break;
      case 'resolved':
        color = Colors.green;
        break;
      case 'closed':
        color = Colors.grey;
        break;
      default:
        color = Colors.black;
    }
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
      decoration: BoxDecoration(color: color.withOpacity(0.1), borderRadius: BorderRadius.circular(12), border: Border.all(color: color)),
      child: Text(status.toUpperCase(), style: TextStyle(color: color, fontSize: 10, fontWeight: FontWeight.bold)),
    );
  }
}
