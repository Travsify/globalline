import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'dart:async';
import 'package:mobile/features/wallet/data/models/wallet_models.dart';
import 'package:mobile/features/wallet/presentation/providers/wallet_repository_provider.dart';

class WalletController extends AsyncNotifier<Wallet> {
  @override
  FutureOr<Wallet> build() async {
    return _fetchWallet();
  }

  Future<Wallet> _fetchWallet() async {
    final repository = ref.read(walletRepositoryProvider);
    return repository.getWallet();
  }

  Future<void> fund(double amount, {String currency = 'USD'}) async {
    state = const AsyncValue.loading();
    try {
      final repository = ref.read(walletRepositoryProvider);
      await repository.fundWallet(amount, currency: currency);
      final wallet = await _fetchWallet();
      state = AsyncValue.data(wallet);
      ref.invalidate(multiCurrencyBalancesProvider);
    } catch (e, st) {
      state = AsyncValue.error(e, st);
    }
  }

  Future<void> refresh() async {
    state = const AsyncValue.loading();
    try {
      final wallet = await _fetchWallet();
      state = AsyncValue.data(wallet);
    } catch (e, st) {
      state = AsyncValue.error(e, st);
    }
  }

  /// Preview a transfer to get fee breakdown before confirming.
  Future<TransferPreview> previewTransfer({
    required double amount,
    required String fromCurrency,
    required String toCurrency,
  }) async {
    final repository = ref.read(walletRepositoryProvider);
    return repository.previewTransfer(
      amount: amount,
      fromCurrency: fromCurrency,
      toCurrency: toCurrency,
    );
  }

  /// Lock a rate for cross-currency operations (60-second expiry).
  Future<RateLock> lockRate({
    required String fromCurrency,
    required String toCurrency,
    required double amount,
  }) async {
    final repository = ref.read(walletRepositoryProvider);
    return repository.lockRate(
      fromCurrency: fromCurrency,
      toCurrency: toCurrency,
      amount: amount,
    );
  }

  /// Execute a transfer with optional rate lock.
  Future<void> transfer({
    required String recipientIdentifier,
    required double amount,
    required String fromCurrency,
    String? toCurrency,
    String? lockId,
  }) async {
    state = const AsyncValue.loading();
    try {
      final repository = ref.read(walletRepositoryProvider);
      await repository.executeTransfer(
        recipientIdentifier: recipientIdentifier,
        amount: amount,
        fromCurrency: fromCurrency,
        toCurrency: toCurrency,
        lockId: lockId,
      );
      final wallet = await _fetchWallet();
      state = AsyncValue.data(wallet);
      ref.invalidate(multiCurrencyBalancesProvider);
    } catch (e, st) {
      state = AsyncValue.error(e, st);
    }
  }

  /// Convert currency for the same user.
  Future<void> convert({
    required String from,
    required String to,
    required double amount,
    String? lockId,
  }) async {
    state = const AsyncValue.loading();
    try {
      final repository = ref.read(walletRepositoryProvider);
      await repository.convert(
        fromCurrency: from,
        toCurrency: to,
        amount: amount,
        lockId: lockId,
      );
      final wallet = await _fetchWallet();
      state = AsyncValue.data(wallet);
      ref.invalidate(multiCurrencyBalancesProvider);
    } catch (e, st) {
      state = AsyncValue.error(e, st);
    }
  }
}

final walletControllerProvider = AsyncNotifierProvider<WalletController, Wallet>(() => WalletController());

final multiCurrencyBalancesProvider = FutureProvider.autoDispose<List<CurrencyBalance>>((ref) async {
  final repository = ref.watch(walletRepositoryProvider);
  return repository.getMultiCurrencyBalances();
});
