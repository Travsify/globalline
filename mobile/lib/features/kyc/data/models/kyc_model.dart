class KycVerification {
  final int id;
  final String idType;
  final String idNumber;
  final String documentUrl;
  final String status;
  final String? reason;
  final DateTime createdAt;

  KycVerification({
    required this.id,
    required this.idType,
    required this.idNumber,
    required this.documentUrl,
    required this.status,
    this.reason,
    required this.createdAt,
  });

  factory KycVerification.fromJson(Map<String, dynamic> json) {
    return KycVerification(
      id: json['id'],
      idType: json['id_type'],
      idNumber: json['id_number'],
      documentUrl: json['document_url'],
      status: json['status'],
      reason: json['reason'],
      createdAt: DateTime.parse(json['created_at']),
    );
  }
}
