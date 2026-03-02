
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
      trackingNumber: json['tracking_number']?.toString() ?? '',
      origin: json['origin']?.toString() ?? '',
      destination: json['destination']?.toString() ?? '',
      status: json['status']?.toString() ?? 'pending',
      estimatedDelivery: DateTime.tryParse(json['estimated_delivery']?.toString() ?? '') ?? DateTime.now(),
      history: (json['history'] as List?)
              ?.map((e) => ShipmentEvent.fromJson(e as Map<String, dynamic>))
              .toList() ??
          [],
      originCountry: json['origin_country']?.toString(),
      destinationCountry: json['destination_country']?.toString(),
      senderName: json['sender_name']?.toString(),
      senderPhone: json['sender_phone']?.toString(),
      senderEmail: json['sender_email']?.toString(),
      receiverName: json['receiver_name']?.toString(),
      receiverPhone: json['receiver_phone']?.toString(),
      receiverEmail: json['receiver_email']?.toString(),
      weight: (json['weight'] as num?)?.toDouble(),
      weightUnit: json['weight_unit']?.toString(),
      length: (json['length'] as num?)?.toDouble(),
      width: (json['width'] as num?)?.toDouble(),
      height: (json['height'] as num?)?.toDouble(),
      packageType: json['package_type']?.toString(),
      declaredValue: (json['declared_value'] as num?)?.toDouble(),
      description: json['description']?.toString(),
      serviceName: json['service_name']?.toString(),
      price: (json['price'] as num?)?.toDouble(),
      currency: json['currency']?.toString(),
      isInsured: json['is_insured'] == true,
      insurancePremium: (json['insurance_premium'] as num?)?.toDouble(),
      pickupType: json['pickup_type']?.toString(),
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
      location: json['location']?.toString() ?? '',
      description: json['description']?.toString() ?? '',
      timestamp: DateTime.tryParse(json['timestamp']?.toString() ?? '') ?? DateTime.now(),
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
      serviceName: json['service_name']?.toString() ?? '',
      price: (json['price'] as num?)?.toDouble() ?? 0.0,
      currency: json['currency']?.toString() ?? 'USD',
      estimatedDays: json['estimated_days']?.toString() ?? '',
    );
  }
}
