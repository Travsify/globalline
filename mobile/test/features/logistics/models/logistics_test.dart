
import 'package:flutter_test/flutter_test.dart';
import 'package:mobile/features/logistics/data/models/logistics_models.dart';

void main() {
  group('Logistics Models', () {
    test('Shipment.fromJson should parse correctly', () {
      final json = {
        'id': 'SH_1',
        'tracking_number': 'GL123',
        'origin': 'Shenzhen',
        'destination': 'Lagos',
        'status': 'In Transit',
        'estimated_delivery': '2026-01-25T10:00:00Z',
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
      expect(shipment.history.length, 1);
      expect(shipment.history[0].location, 'Shenzhen');
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
