class SupportTicket {
  final int id;
  final String subject;
  final String category;
  final String priority;
  final String status;
  final DateTime createdAt;
  final List<SupportMessage> messages;

  SupportTicket({
    required this.id,
    required this.subject,
    required this.category,
    required this.priority,
    required this.status,
    required this.createdAt,
    this.messages = const [],
  });

  factory SupportTicket.fromJson(Map<String, dynamic> json) {
    return SupportTicket(
      id: (json['id'] as num?)?.toInt() ?? 0,
      subject: json['subject']?.toString() ?? '',
      category: json['category']?.toString() ?? '',
      priority: json['priority']?.toString() ?? '',
      status: json['status']?.toString() ?? '',
      createdAt: DateTime.tryParse(json['created_at']?.toString() ?? '') ?? DateTime.now(),
      messages: (json['messages'] as List?)
          ?.map((e) => SupportMessage.fromJson(e as Map<String, dynamic>))
          .toList() ?? [],
    );
  }
}

class SupportMessage {
  final int id;
  final int userId;
  final String message;
  final String? attachmentUrl;
  final bool isAdmin;
  final DateTime createdAt;
  final String? userName;

  SupportMessage({
    required this.id,
    required this.userId,
    required this.message,
    this.attachmentUrl,
    required this.isAdmin,
    required this.createdAt,
    this.userName,
  });

  factory SupportMessage.fromJson(Map<String, dynamic> json) {
    return SupportMessage(
      id: (json['id'] as num?)?.toInt() ?? 0,
      userId: (json['user_id'] as num?)?.toInt() ?? 0,
      message: json['message']?.toString() ?? '',
      attachmentUrl: json['attachment_url']?.toString(),
      isAdmin: json['is_admin'] == 1 || json['is_admin'] == true,
      createdAt: DateTime.tryParse(json['created_at']?.toString() ?? '') ?? DateTime.now(),
      userName: json['user']?['name']?.toString(),
    );
  }
}
