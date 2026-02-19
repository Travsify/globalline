
import 'package:flutter_test/flutter_test.dart';
import 'package:mobile/features/logistics/data/models/logistics_models.dart';

void main() {
  group('Logistics Models', () {
    test('Shipment.fromJson should parse correctly with all fields', () {
      final json = {
        'id': 'SH_1',
        'tracking_number': 'GL123',
        'origin': 'Shenzhen',
        'destination': 'Lagos',
        'status': 'In Transit',
        'estimated_delivery': '2026-01-25T10:00:00Z',
        'origin_country': 'China',
        'destination_country': 'Nigeria',
        'sender_name': 'John Doe',
        'sender_phone': '+8613812345678',
        'receiver_name': 'Ade Adeyemi',
        'receiver_phone': '+2348012345678',
        'weight': 5.5,
        'package_type': 'small_box',
        'declared_value': 150.0,
        'description': 'Electronics',
        'service_name': 'GlobalLine Express',
        'is_insured': true,
        'history': [
          {
            'location': 'Shenzhen',
            'description': 'Picked up',
            'timestamp': '2026-01-20T10:00:00Z',
          }
        ],
      };

      final shipment = Shipment.fromJson(json);

      expect(shipment.id, 'SH_1');
      expect(shipment.trackingNumber, 'GL123');
      expect(shipment.status, 'In Transit');
      expect(shipment.originCountry, 'China');
      expect(shipment.destinationCountry, 'Nigeria');
      expect(shipment.senderName, 'John Doe');
      expect(shipment.receiverName, 'Ade Adeyemi');
      expect(shipment.weight, 5.5);
      expect(shipment.packageType, 'small_box');
      expect(shipment.declaredValue, 150.0);
      expect(shipment.isInsured, true);
      expect(shipment.history.length, 1);
      expect(shipment.history[0].location, 'Shenzhen');
    });

    test('Shipment.fromJson handles missing optional fields gracefully', () {
      final json = {
        'id': 'SH_2',
        'tracking_number': 'GL456',
        'origin': 'Lagos',
        'destination': 'London',
        'status': 'pending',
        'estimated_delivery': '2026-02-10T10:00:00Z',
        'history': [],
      };

      final shipment = Shipment.fromJson(json);

      expect(shipment.id, 'SH_2');
      expect(shipment.originCountry, isNull);
      expect(shipment.senderName, isNull);
      expect(shipment.weight, isNull);
      expect(shipment.isInsured, false);
      expect(shipment.history, isEmpty);
    });

    test('ShippingRate.fromJson should parse correctly', () {
      final json = {
        'service_name': 'Express',
        'price': 45.5,
        'currency': 'USD',
        'estimated_days': '3-5 Days',
      };

      final rate = ShippingRate.fromJson(json);

      expect(rate.serviceName, 'Express');
      expect(rate.price, 45.5);
      expect(rate.currency, 'USD');
    });
  });
}
