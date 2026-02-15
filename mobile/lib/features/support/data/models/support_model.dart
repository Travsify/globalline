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
      id: json['id'],
      subject: json['subject'],
      category: json['category'],
      priority: json['priority'],
      status: json['status'],
      createdAt: DateTime.parse(json['created_at']),
      messages: json['messages'] != null
          ? (json['messages'] as List).map((e) => SupportMessage.fromJson(e)).toList()
          : [],
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
      id: json['id'],
      userId: json['user_id'],
      message: json['message'],
      attachmentUrl: json['attachment_url'],
      isAdmin: json['is_admin'] == 1 || json['is_admin'] == true,
      createdAt: DateTime.parse(json['created_at']),
      userName: json['user']?['name'],
    );
  }
}
