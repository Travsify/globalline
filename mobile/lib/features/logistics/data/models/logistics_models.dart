
class Shipment {
  final String id;
  final String trackingNumber;
  final String origin;
  final String destination;
  final String status;
  final DateTime estimatedDelivery;
  final List<ShipmentEvent> history;

  // Enhanced fields
  final String? originCountry;
  final String? destinationCountry;
  final String? senderName;
  final String? senderPhone;
  final String? senderEmail;
  final String? receiverName;
  final String? receiverPhone;
  final String? receiverEmail;
  final double? weight;
  final String? weightUnit;
  final double? length;
  final double? width;
  final double? height;
  final String? packageType;
  final double? declaredValue;
  final String? description;
  final String? serviceName;
  final double? price;
  final String? currency;
  final bool isInsured;
  final double? insurancePremium;
  final String? pickupType;

  Shipment({
    required this.id,
    required this.trackingNumber,
    required this.origin,
    required this.destination,
    required this.status,
    required this.estimatedDelivery,
    required this.history,
    this.originCountry,
    this.destinationCountry,
    this.senderName,
    this.senderPhone,
    this.senderEmail,
    this.receiverName,
    this.receiverPhone,
    this.receiverEmail,
    this.weight,
    this.weightUnit,
    this.length,
    this.width,
    this.height,
    this.packageType,
    this.declaredValue,
    this.description,
    this.serviceName,
    this.price,
    this.currency,
    this.isInsured = false,
    this.insurancePremium,
    this.pickupType,
  });

  factory Shipment.fromJson(Map<String, dynamic> json) {
    return Shipment(
      id: json['id']?.toString() ?? '',
      trackingNumber: json['tracking_number'] as String? ?? '',
      origin: json['origin'] as String? ?? '',
      destination: json['destination'] as String? ?? '',
      status: json['status'] as String? ?? 'pending',
      estimatedDelivery: json['estimated_delivery'] != null
          ? DateTime.parse(json['estimated_delivery'] as String)
          : DateTime.now(),
      history: json['history'] != null
          ? (json['history'] as List).map((e) => ShipmentEvent.fromJson(e)).toList()
          : [],
      originCountry: json['origin_country'] as String?,
      destinationCountry: json['destination_country'] as String?,
      senderName: json['sender_name'] as String?,
      senderPhone: json['sender_phone'] as String?,
      senderEmail: json['sender_email'] as String?,
      receiverName: json['receiver_name'] as String?,
      receiverPhone: json['receiver_phone'] as String?,
      receiverEmail: json['receiver_email'] as String?,
      weight: (json['weight'] as num?)?.toDouble(),
      weightUnit: json['weight_unit'] as String?,
      length: (json['length'] as num?)?.toDouble(),
      width: (json['width'] as num?)?.toDouble(),
      height: (json['height'] as num?)?.toDouble(),
      packageType: json['package_type'] as String?,
      declaredValue: (json['declared_value'] as num?)?.toDouble(),
      description: json['description'] as String?,
      serviceName: json['service_name'] as String?,
      price: (json['price'] as num?)?.toDouble(),
      currency: json['currency'] as String?,
      isInsured: json['is_insured'] == true,
      insurancePremium: (json['insurance_premium'] as num?)?.toDouble(),
      pickupType: json['pickup_type'] as String?,
    );
  }
}

class ShipmentEvent {
  final String location;
  final String description;
  final DateTime timestamp;

  ShipmentEvent({
    required this.location,
    required this.description,
    required this.timestamp,
  });

  factory ShipmentEvent.fromJson(Map<String, dynamic> json) {
    return ShipmentEvent(
      location: json['location'] as String,
      description: json['description'] as String,
      timestamp: DateTime.parse(json['timestamp'] as String),
    );
  }
}

class ShippingRate {
  final String serviceName;
  final double price;
  final String currency;
  final String estimatedDays;

  ShippingRate({
    required this.serviceName,
    required this.price,
    required this.currency,
    required this.estimatedDays,
  });

  factory ShippingRate.fromJson(Map<String, dynamic> json) {
    return ShippingRate(
      serviceName: json['service_name'] as String,
      price: (json['price'] as num).toDouble(),
      currency: json['currency'] as String,
      estimatedDays: json['estimated_days'] as String,
    );
  }
}
