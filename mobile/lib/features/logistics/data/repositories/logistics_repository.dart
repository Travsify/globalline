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
    required String originCountry,
    required String destination,
    required String destinationCountry,
    required double weight,
    required String serviceName,
    required String senderName,
    required String senderPhone,
    required String receiverName,
    required String receiverPhone,
    String? senderEmail,
    String? receiverEmail,
    String? description,
    String? packageType,
    double? length,
    double? width,
    double? height,
    double? declaredValue,
    bool isInsured = false,
    String pickupType = 'drop_off',
  });

  Future<Shipment> trackShipment(String trackingNumber);

  Future<List<Shipment>> getShipments();

  Future<void> consolidateShipments(List<String> shipmentIds);

  Future<List<dynamic>> getConsolidations();

  Future<Shipment> shipForMe({
    required String externalTracking,
    required String itemName,
    required int quantity,
    String? notes,
  });
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
    required String originCountry,
    required String destination,
    required String destinationCountry,
    required double weight,
    required String serviceName,
    required String senderName,
    required String senderPhone,
    required String receiverName,
    required String receiverPhone,
    String? senderEmail,
    String? receiverEmail,
    String? description,
    String? packageType,
    double? length,
    double? width,
    double? height,
    double? declaredValue,
    bool isInsured = false,
    String pickupType = 'drop_off',
  }) async {
    try {
      final data = <String, dynamic>{
        'origin': origin,
        'origin_country': originCountry,
        'destination': destination,
        'destination_country': destinationCountry,
        'weight': weight,
        'service_name': serviceName,
        'sender_name': senderName,
        'sender_phone': senderPhone,
        'receiver_name': receiverName,
        'receiver_phone': receiverPhone,
        'is_insured': isInsured,
        'pickup_type': pickupType,
      };
      if (senderEmail != null) data['sender_email'] = senderEmail;
      if (receiverEmail != null) data['receiver_email'] = receiverEmail;
      if (description != null) data['description'] = description;
      if (packageType != null) data['package_type'] = packageType;
      if (length != null) data['length'] = length;
      if (width != null) data['width'] = width;
      if (height != null) data['height'] = height;
      if (declaredValue != null) data['declared_value'] = declaredValue;

      final response = await _dio.post('logistics/shipments', data: data);
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

  @override
  Future<List<Shipment>> getShipments() async {
    try {
      final response = await _dio.get('logistics');
      return (response.data as List).map((e) => Shipment.fromJson(e)).toList();
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> consolidateShipments(List<String> shipmentIds) async {
    try {
      await _dio.post('enterprise/consolidate', data: {
        'shipment_ids': shipmentIds,
      });
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<List<dynamic>> getConsolidations() async {
    try {
      final response = await _dio.get('enterprise/consolidations');
      return response.data['data'] as List;
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<Shipment> shipForMe({
    required String externalTracking,
    required String itemName,
    required int quantity,
    String? notes,
  }) async {
    try {
      final response = await _dio.post('enterprise/ship-for-me', data: {
        'external_tracking': externalTracking,
        'item_name': itemName,
        'quantity': quantity,
        'notes': notes,
      });
      return Shipment.fromJson(response.data['data']);
    } on DioException catch (e) {
      throw e.error!;
    }
  }
}
