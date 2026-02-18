import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/marketplace/presentation/providers/marketplace_provider.dart';
import 'package:mobile/shared/widgets/status_widgets.dart';

class SourcingListScreen extends ConsumerWidget {
  const SourcingListScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final sourcingAsync = ref.watch(sourcingRequestsProvider);

    return Scaffold(
      backgroundColor: const Color(0xFF002366),
      appBar: AppBar(
        title: const Text('My Sourcing Requests', 
          style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
      ),
      body: sourcingAsync.when(
        data: (requests) {
          if (requests.isEmpty) {
            return _buildEmptyState(context);
          }

          return ListView.builder(
            padding: const EdgeInsets.all(16),
            itemCount: requests.length,
            itemBuilder: (context, index) {
              final req = requests[index];
              return _SourcingRequestCard(request: req);
            },
          );
        },
        loading: () => const AppLoadingWidget(),
        error: (err, stack) => AppErrorWidget(message: err.toString()),
      ),
      floatingActionButton: FloatingActionButton.extended(
        onPressed: () => context.push('/marketplace/sourcing/create'),
        backgroundColor: const Color(0xFFFFD700),
        foregroundColor: const Color(0xFF002366),
        icon: const Icon(Icons.add),
        label: const Text("New Request", style: TextStyle(fontWeight: FontWeight.bold)),
      ),
    );
  }

  Widget _buildEmptyState(BuildContext context) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.assignment_outlined, size: 80, color: Colors.white.withOpacity(0.2)),
          const SizedBox(height: 24),
          const Text("No sourcing requests found.", 
            style: TextStyle(color: Colors.white70, fontSize: 16)),
          const SizedBox(height: 16),
          ElevatedButton(
            onPressed: () => context.push('/marketplace/sourcing/create'),
            style: ElevatedButton.styleFrom(backgroundColor: const Color(0xFFFFD700)),
            child: const Text("SUBMIT YOUR FIRST REQUEST", style: TextStyle(color: Color(0xFF002366))),
          ),
        ],
      ),
    );
  }
}

class _SourcingRequestCard extends StatelessWidget {
  final dynamic request;
  const _SourcingRequestCard({required this.request});

  @override
  Widget build(BuildContext context) {
    final status = request['status'] ?? 'pending';
    final color = status == 'open' ? Colors.blue : (status == 'completed' ? Colors.green : Colors.orange);

    return Card(
      color: Colors.white.withOpacity(0.05),
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(16),
        side: BorderSide(color: Colors.white.withOpacity(0.1)),
      ),
      margin: const EdgeInsets.only(bottom: 12),
      child: ListTile(
        title: Text(request['product_name'] ?? 'Untitled Item', 
          style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
        subtitle: Text(request['description'] ?? '', 
          style: const TextStyle(color: Colors.white70), maxLines: 2, overflow: TextOverflow.ellipsis),
        trailing: Container(
          padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
          decoration: BoxDecoration(
            color: color.withOpacity(0.2),
            borderRadius: BorderRadius.circular(12),
            border: Border.all(color: color.withOpacity(0.5)),
          ),
          child: Text(status.toUpperCase(), 
            style: TextStyle(color: color, fontSize: 10, fontWeight: FontWeight.bold)),
        ),
      ),
    );
  }
}
