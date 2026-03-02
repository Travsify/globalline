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
      id: (json['id'] as num?)?.toInt() ?? 0,
      idType: json['id_type']?.toString() ?? '',
      idNumber: json['id_number']?.toString() ?? '',
      documentUrl: json['document_url']?.toString() ?? '',
      status: json['status']?.toString() ?? 'pending',
      reason: json['reason']?.toString(),
      createdAt: DateTime.tryParse(json['created_at']?.toString() ?? '') ?? DateTime.now(),
    );
  }
}
