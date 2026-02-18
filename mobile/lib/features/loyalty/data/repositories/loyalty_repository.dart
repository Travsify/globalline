import 'package:dio/dio.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';
import 'package:mobile/features/loyalty/data/models/loyalty_model.dart';

abstract class LoyaltyRepository {
  Future<LoyaltyStats> getStats();
}

class RealLoyaltyRepository implements LoyaltyRepository {
  final Dio _dio;
  RealLoyaltyRepository(this._dio);

  @override
  Future<LoyaltyStats> getStats() async {
    final response = await _dio.get('loyalty/stats');
    return LoyaltyStats.fromJson(response.data);
  }
}

final loyaltyRepositoryProvider = Provider<LoyaltyRepository>((ref) {
  return RealLoyaltyRepository(ref.watch(dioProvider));
});

final loyaltyStatsProvider = FutureProvider.autoDispose<LoyaltyStats>((ref) async {
  return ref.watch(loyaltyRepositoryProvider).getStats();
});
