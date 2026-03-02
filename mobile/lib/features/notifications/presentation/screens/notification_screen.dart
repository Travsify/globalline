import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/notifications/data/repositories/notification_repository.dart';

class NotificationScreen extends ConsumerWidget {
  const NotificationScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final notificationsAsync = ref.watch(notificationsProvider);

    return Scaffold(
      appBar: AppBar(title: const Text('Notifications')),
      body: notificationsAsync.when(
        data: (notifications) => ListView.builder(
          itemCount: notifications.length,
          itemBuilder: (context, index) {
            final notification = notifications[index];
            return Container(
              color: notification.isRead ? Colors.transparent : Theme.of(context).colorScheme.primary.withOpacity(0.05),
              child: ListTile(
                leading: CircleAvatar(
                  backgroundColor: _getIconColor(notification.type).withOpacity(0.1),
                  child: Icon(_getIcon(notification.type), color: _getIconColor(notification.type)),
                ),
                title: Text(
                  notification.title,
                  style: TextStyle(fontWeight: notification.isRead ? FontWeight.normal : FontWeight.bold),
                ),
                subtitle: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const SizedBox(height: 4),
                    Text(notification.message),
                    const SizedBox(height: 4),
                    Text(
                      _formatDate(notification.date),
                      style: TextStyle(fontSize: 12, color: Colors.grey[600]),
                    ),
                  ],
                ),
                isThreeLine: true,
              ),
            );
          },
        ),
        loading: () => const Center(child: CircularProgressIndicator()),
        error: (err, stack) => Center(child: Text('Error: $err')),
      ),
    );
  }

  IconData _getIcon(String type) {
    switch (type) {
      case 'Order': return Icons.local_shipping;
      case 'Promo': return Icons.local_offer;
      case 'System': return Icons.info;
      default: return Icons.notifications;
    }
  }

  Color _getIconColor(String type) {
    switch (type) {
      case 'Order': return Colors.blue;
      case 'Promo': return Colors.orange;
      case 'System': return Colors.grey;
      default: return Colors.blue;
    }
  }

  String _formatDate(DateTime date) {
    // Simple mock format
    return "${date.day}/${date.month} ${date.hour}:${date.minute}"; 
  }
}
