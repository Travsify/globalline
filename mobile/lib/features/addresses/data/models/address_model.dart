
class Address {
  final String id;
  final String label; // "Home", "Office"
  final String recipientName;
  final String street;
  final String city;
  final String country;
  final String zip;
  final String phone;
  final bool isDefault;

  Address({
    required this.id,
    required this.label,
    required this.recipientName,
    required this.street,
    required this.city,
    required this.country,
    required this.zip,
    required this.phone,
    required this.isDefault,
  });
}
