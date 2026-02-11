
class Shipment {
  final String id;
  final String trackingNumber;
  final String origin;
  final String destination;
  final String status;
  final DateTime estimatedDelivery;
  final List<ShipmentEvent> history;

  Shipment({
    required this.id,
    required this.trackingNumber,
    required this.origin,
    required this.destination,
    required this.status,
    required this.estimatedDelivery,
    required this.history,
  });

  factory Shipment.fromJson(Map<String, dynamic> json) {
    return Shipment(
      id: json['id'] as String,
      trackingNumber: json['tracking_number'] as String,
      origin: json['origin'] as String,
      destination: json['destination'] as String,
      status: json['status'] as String,
      estimatedDelivery: DateTime.parse(json['estimated_delivery'] as String),
      history: (json['history'] as List)
          .map((e) => ShipmentEvent.fromJson(e))
          .toList(),
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
