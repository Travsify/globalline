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
    
    // Mapping status to pipeline steps
    final int currentStep;
    switch (status.toString().toLowerCase()) {
      case 'pending': currentStep = 0; break;
      case 'reviewing': currentStep = 1; break;
      case 'quotes_ready': currentStep = 2; break;
      case 'ordered': currentStep = 3; break;
      case 'completed': currentStep = 4; break;
      default: currentStep = 0;
    }

    return Card(
      color: Colors.white.withOpacity(0.05),
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(24),
        side: BorderSide(color: Colors.white.withOpacity(0.1)),
      ),
      margin: const EdgeInsets.only(bottom: 16),
      child: Padding(
        padding: const EdgeInsets.all(20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        request['product_name'] ?? 'Untitled Item', 
                        style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 18, fontFamily: 'Outfit'),
                      ),
                      const SizedBox(height: 4),
                      Text(
                        "Ref: ${request['id'] ?? 'N/A'}", 
                        style: TextStyle(color: Colors.white.withOpacity(0.4), fontSize: 10),
                      ),
                    ],
                  ),
                ),
                _buildStatusIcon(status),
              ],
            ),
            const SizedBox(height: 16),
            Text(
              request['description'] ?? '', 
              style: TextStyle(color: Colors.white.withOpacity(0.7), fontSize: 13),
              maxLines: 2,
              overflow: TextOverflow.ellipsis,
            ),
            const SizedBox(height: 24),
            _buildPipeline(currentStep),
          ],
        ),
      ),
    );
  }

  Widget _buildStatusIcon(String status) {
    IconData icon = Icons.hourglass_empty;
    Color color = Colors.orange;
    
    if (status == 'completed') {
      icon = Icons.check_circle_outline;
      color = Colors.green;
    } else if (status == 'quotes_ready') {
      icon = Icons.request_quote_outlined;
      color = Colors.blue;
    }

    return Container(
      padding: const EdgeInsets.all(8),
      decoration: BoxDecoration(color: color.withOpacity(0.1), shape: BoxShape.circle),
      child: Icon(icon, color: color, size: 20),
    );
  }

  Widget _buildPipeline(int currentStep) {
    final steps = ['Submitted', 'Reviewing', 'Quotes', 'Ordered'];
    
    return Row(
      children: List.generate(steps.length, (index) {
        final isActive = index <= currentStep;
        final isLast = index == steps.length - 1;
        
        return Expanded(
          child: Column(
            children: [
              Row(
                children: [
                  Expanded(child: Container(height: 2, color: index == 0 ? Colors.transparent : (isActive ? const Color(0xFFFFD700) : Colors.white10))),
                  Container(
                    width: 12,
                    height: 12,
                    decoration: BoxDecoration(
                      color: isActive ? const Color(0xFFFFD700) : Colors.transparent,
                      shape: BoxShape.circle,
                      border: Border.all(color: isActive ? const Color(0xFFFFD700) : Colors.white24, width: 2),
                    ),
                  ),
                  Expanded(child: Container(height: 2, color: isLast ? Colors.transparent : (index < currentStep ? const Color(0xFFFFD700) : Colors.white10))),
                ],
              ),
              const SizedBox(height: 8),
              Text(
                steps[index],
                style: TextStyle(
                  color: isActive ? Colors.white : Colors.white24,
                  fontSize: 8,
                  fontWeight: isActive ? FontWeight.bold : FontWeight.normal,
                ),
              ),
            ],
          ),
        );
      }),
    );
  }
}
