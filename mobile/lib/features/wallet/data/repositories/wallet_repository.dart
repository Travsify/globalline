import 'package:dio/dio.dart';
import 'package:mobile/features/wallet/data/models/wallet_models.dart';

abstract class WalletRepository {
  Future<Wallet> getWallet();
  Future<void> fundWallet(double amount);
  Future<List<dynamic>> getMultiCurrencyBalances();
  Future<void> convertCurrency({
    required String from,
    required String to,
    required double amount,
  });
}

class RealWalletRepository implements WalletRepository {
  final Dio _dio;

  RealWalletRepository(this._dio);

  @override
  Future<Wallet> getWallet() async {
    try {
      final response = await _dio.get('wallet/balance');
      return Wallet.fromJson(response.data);
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> fundWallet(double amount) async {
    try {
      await _dio.post('wallet/fund', data: {'amount': amount});
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<List<dynamic>> getMultiCurrencyBalances() async {
    try {
      final response = await _dio.get('enterprise/wallets');
      return response.data['data'] as List;
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> convertCurrency({
    required String from,
    required String to,
    required double amount,
  }) async {
    try {
      await _dio.post('enterprise/convert', data: {
        'from': from,
        'to': to,
        'amount': amount,
      });
    } on DioException catch (e) {
      throw e.error!;
    }
  }
}
