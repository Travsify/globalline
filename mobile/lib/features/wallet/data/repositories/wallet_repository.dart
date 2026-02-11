import 'package:dio/dio.dart';
import 'package:mobile/features/wallet/data/models/wallet_models.dart';

abstract class WalletRepository {
  Future<Wallet> getWallet();
  Future<void> fundWallet(double amount);
}

class RealWalletRepository implements WalletRepository {
  final Dio _dio;

  RealWalletRepository(this._dio);

  @override
  Future<Wallet> getWallet() async {
    try {
      final response = await _dio.get('/wallet/balance');
      return Wallet.fromJson(response.data);
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> fundWallet(double amount) async {
    try {
      await _dio.post('/wallet/fund', data: {'amount': amount});
    } on DioException catch (e) {
      throw e.error!;
    }
  }
}
