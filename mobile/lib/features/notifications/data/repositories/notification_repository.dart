import 'package:dio/dio.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';
import 'package:mobile/features/notifications/data/models/notification_model.dart';

abstract class NotificationRepository {
  Future<List<AppNotification>> getNotifications();
}

class RealNotificationRepository implements NotificationRepository {
  final Dio _dio;

  RealNotificationRepository(this._dio);

  @override
  Future<List<AppNotification>> getNotifications() async {
    try {
      final response = await _dio.get('/notifications');
      final List data = response.data['data'];
      return data.map((e) => AppNotification.fromJson(e)).toList();
    } on DioException catch (e) {
      throw e.error!;
    }
  }
}

final notificationRepositoryProvider = Provider<NotificationRepository>((ref) {
  final dio = ref.watch(dioProvider);
  return RealNotificationRepository(dio);
});

final notificationsProvider = FutureProvider.autoDispose<List<AppNotification>>((ref) async {
  final repository = ref.watch(notificationRepositoryProvider);
  return repository.getNotifications();
});
