import 'package:dio/dio.dart';
import 'package:mobile/features/wallet/data/models/wallet_models.dart';

abstract class WalletRepository {
  Future<Wallet> getWallet();
  Future<void> fundWallet(double amount, {String currency = 'USD'});
  Future<List<CurrencyBalance>> getMultiCurrencyBalances();
  Future<TransferPreview> previewTransfer({
    required double amount,
    required String fromCurrency,
    required String toCurrency,
  });
  Future<RateLock> lockRate({
    required String fromCurrency,
    required String toCurrency,
    required double amount,
  });
  Future<Map<String, dynamic>> executeTransfer({
    required String recipientIdentifier,
    required double amount,
    required String fromCurrency,
    String? toCurrency,
    String? lockId,
  });
  Future<Map<String, dynamic>> convert({
    required String fromCurrency,
    required String toCurrency,
    required double amount,
    String? lockId,
  });
  Future<List<WalletTransaction>> getStatement({String? currency});
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
      throw e.error ?? e.message ?? 'Failed to fetch wallet';
    }
  }

  @override
  Future<void> fundWallet(double amount, {String currency = 'USD'}) async {
    try {
      await _dio.post('wallet/fund', data: {
        'amount': amount,
        'currency': currency,
      });
    } on DioException catch (e) {
      throw e.error ?? e.message ?? 'Failed to fund wallet';
    }
  }

  @override
  Future<List<CurrencyBalance>> getMultiCurrencyBalances() async {
    try {
      final response = await _dio.get('enterprise/wallets');
      final list = response.data['data'] as List;
      return list.map((e) => CurrencyBalance.fromJson(e)).toList();
    } on DioException catch (e) {
      throw e.error ?? e.message ?? 'Failed to fetch balances';
    }
  }

  @override
  Future<TransferPreview> previewTransfer({
    required double amount,
    required String fromCurrency,
    required String toCurrency,
  }) async {
    try {
      final response = await _dio.post('wallet/preview-transfer', data: {
        'amount': amount,
        'from_currency': fromCurrency,
        'to_currency': toCurrency,
      });
      return TransferPreview.fromJson(response.data['data']);
    } on DioException catch (e) {
      throw e.error ?? e.message ?? 'Failed to preview transfer';
    }
  }

  @override
  Future<RateLock> lockRate({
    required String fromCurrency,
    required String toCurrency,
    required double amount,
  }) async {
    try {
      final response = await _dio.post('wallet/lock-rate', data: {
        'from_currency': fromCurrency,
        'to_currency': toCurrency,
        'amount': amount,
      });
      return RateLock.fromJson(response.data['data']);
    } on DioException catch (e) {
      throw e.error ?? e.message ?? 'Failed to lock rate';
    }
  }

  @override
  Future<Map<String, dynamic>> executeTransfer({
    required String recipientIdentifier,
    required double amount,
    required String fromCurrency,
    String? toCurrency,
    String? lockId,
  }) async {
    try {
      final response = await _dio.post('wallet/transfer', data: {
        'recipient_identifier': recipientIdentifier,
        'amount': amount,
        'from_currency': fromCurrency,
        'to_currency': toCurrency ?? fromCurrency,
        if (lockId != null) 'lock_id': lockId,
      });
      return response.data as Map<String, dynamic>;
    } on DioException catch (e) {
      throw e.error ?? e.message ?? 'Transfer failed';
    }
  }

  @override
  Future<Map<String, dynamic>> convert({
    required String fromCurrency,
    required String toCurrency,
    required double amount,
    String? lockId,
  }) async {
    try {
      final response = await _dio.post('wallet/convert', data: {
        'from_currency': fromCurrency,
        'to_currency': toCurrency,
        'amount': amount,
        if (lockId != null) 'lock_id': lockId,
      });
      return response.data as Map<String, dynamic>;
    } on DioException catch (e) {
      throw e.error ?? e.message ?? 'Conversion failed';
    }
  }

  @override
  Future<List<WalletTransaction>> getStatement({String? currency}) async {
    try {
      final response = await _dio.get('wallet/statement', queryParameters: {
        if (currency != null) 'currency': currency,
      });
      final list = response.data['data'] as List;
      return list.map((e) => WalletTransaction.fromJson(e)).toList();
    } on DioException catch (e) {
      throw e.error ?? e.message ?? 'Failed to fetch statement';
    }
  }
}
