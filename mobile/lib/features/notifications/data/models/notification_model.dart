
class AppNotification {
  final String id;
  final String title;
  final String message;
  final DateTime date;
  final bool isRead;
  final String type; // 'Order', 'Promo', 'System'

  AppNotification({
    required this.id,
    required this.title,
    required this.message,
    required this.date,
    required this.isRead,
    required this.type,
  });

  factory AppNotification.fromJson(Map<String, dynamic> json) {
    return AppNotification(
      id: json['id']?.toString() ?? '',
      title: json['title']?.toString() ?? '',
      message: json['message']?.toString() ?? '',
      date: DateTime.tryParse(json['created_at']?.toString() ?? '') ?? DateTime.now(),
      isRead: json['is_read'] == 1 || json['is_read'] == true,
      type: json['type']?.toString() ?? 'System',
    );
  }
}
