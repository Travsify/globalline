import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';
import 'package:mobile/features/logistics/data/models/logistics_models.dart';
import 'package:mobile/features/logistics/data/repositories/logistics_repository.dart';

final logisticsRepositoryProvider = Provider<LogisticsRepository>((ref) {
  final dio = ref.watch(dioProvider);
  return RealLogisticsRepository(dio);
});

// State for Rate Calculator
final shippingRatesProvider = FutureProvider.autoDispose.family<List<ShippingRate>, ({String origin, String destination, double weight})>((ref, args) async {
  final repository = ref.watch(logisticsRepositoryProvider);
  return repository.getRates(origin: args.origin, destination: args.destination, weight: args.weight);
});

// State for Tracking
final shipmentTrackingProvider = FutureProvider.autoDispose.family<Shipment, String>((ref, trackingNumber) async {
  final repository = ref.watch(logisticsRepositoryProvider);
  return repository.trackShipment(trackingNumber);
});

// List of all user shipments for consolidation
final userShipmentsProvider = FutureProvider.autoDispose<List<Shipment>>((ref) async {
  final repository = ref.watch(logisticsRepositoryProvider);
  return repository.getShipments();
});

// Mock implementation for development/testing if needed
class MockLogisticsRepository implements LogisticsRepository {
  @override
  Future<List<ShippingRate>> getRates({required String origin, required String destination, required double weight}) async => [];
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
  }) async => throw UnimplementedError();
  @override
  Future<Shipment> trackShipment(String trackingNumber) async => throw UnimplementedError();
  @override
  Future<List<Shipment>> getShipments() async => [];
  @override
  Future<void> consolidateShipments(List<String> shipmentIds) async => throw UnimplementedError();
  @override
  Future<List<dynamic>> getConsolidations() async => throw UnimplementedError();
  @override
  Future<Shipment> shipForMe({required String externalTracking, required String itemName, required int quantity, String? notes}) async => throw UnimplementedError();
}
