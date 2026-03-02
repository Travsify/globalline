class Address {
  final int? id;
  final String label;
  final String recipientName;
  final String street;
  final String city;
  final String country;
  final String? zipCode;
  final String phone;
  final bool isDefault;

  Address({
    this.id,
    required this.label,
    required this.recipientName,
    required this.street,
    required this.city,
    required this.country,
    this.zipCode,
    required this.phone,
    this.isDefault = false,
  });

  factory Address.fromJson(Map<String, dynamic> json) {
    return Address(
      id: json['id'] is int ? json['id'] as int : int.tryParse(json['id']?.toString() ?? ''),
      label: json['label']?.toString() ?? '',
      recipientName: json['recipient_name']?.toString() ?? '',
      street: json['street']?.toString() ?? '',
      city: json['city']?.toString() ?? '',
      country: json['country']?.toString() ?? '',
      zipCode: json['zip_code']?.toString(),
      phone: json['phone']?.toString() ?? '',
      isDefault: json['is_default'] == 1 || json['is_default'] == true,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'label': label,
      'recipient_name': recipientName,
      'street': street,
      'city': city,
      'country': country,
      'zip_code': zipCode,
      'phone': phone,
      'is_default': isDefault,
    };
  }
}
