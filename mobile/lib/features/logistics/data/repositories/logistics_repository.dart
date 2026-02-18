import 'package:dio/dio.dart';
import 'package:mobile/features/logistics/data/models/logistics_models.dart';

abstract class LogisticsRepository {
  Future<List<ShippingRate>> getRates({
    required String origin,
    required String destination,
    required double weight,
  });

  Future<Shipment> createShipment({
    required String origin,
    required String destination,
    required double weight,
    required String serviceName,
  });

  Future<Shipment> trackShipment(String trackingNumber);
}

class RealLogisticsRepository implements LogisticsRepository {
  final Dio _dio;

  RealLogisticsRepository(this._dio);

  @override
  Future<List<ShippingRate>> getRates({
    required String origin,
    required String destination,
    required double weight,
  }) async {
    try {
      final response = await _dio.get('logistics/rates', queryParameters: {
        'origin': origin,
        'destination': destination,
        'weight': weight,
      });

      return (response.data['rates'] as List)
          .map((e) => ShippingRate.fromJson(e))
          .toList();
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<Shipment> createShipment({
    required String origin,
    required String destination,
    required double weight,
    required String serviceName,
  }) async {
    try {
      final response = await _dio.post('logistics/shipments', data: {
        'origin': origin,
        'destination': destination,
        'weight': weight,
        'service_name': serviceName,
      });

      return Shipment.fromJson(response.data);
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<Shipment> trackShipment(String trackingNumber) async {
    try {
      final response = await _dio.get('logistics/track/$trackingNumber');
      return Shipment.fromJson(response.data);
    } on DioException catch (e) {
      throw e.error!;
    }
  }
}
