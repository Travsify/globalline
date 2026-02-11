import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/notifications/data/models/notification_model.dart';

abstract class NotificationRepository {
  Future<List<AppNotification>> getNotifications();
}

class MockNotificationRepository implements NotificationRepository {
  @override
  Future<List<AppNotification>> getNotifications() async {
    await Future.delayed(const Duration(seconds: 1));
    return [
      AppNotification(
        id: "NOT-1",
        title: "Order Shipped",
        message: "Your shipment GL12345 has been shipped via DHL.",
        date: DateTime.now().subtract(const Duration(hours: 2)),
        isRead: false,
        type: "Order",
      ),
      AppNotification(
        id: "NOT-2",
        title: "Welcome Bonus",
        message: "You have received \$50 credit in your wallet.",
        date: DateTime.now().subtract(const Duration(days: 1)),
        isRead: true,
        type: "Promo",
      ),
        AppNotification(
        id: "NOT-3",
        title: "System Maintenance",
        message: "Scheduled maintenance on Sunday 12:00 AM.",
        date: DateTime.now().subtract(const Duration(days: 2)),
        isRead: true,
        type: "System",
      ),
    ];
  }
}

final notificationRepositoryProvider = Provider<NotificationRepository>((ref) {
  return MockNotificationRepository();
});

final notificationsProvider = FutureProvider.autoDispose<List<AppNotification>>((ref) async {
  final repository = ref.watch(notificationRepositoryProvider);
  return repository.getNotifications();
});
