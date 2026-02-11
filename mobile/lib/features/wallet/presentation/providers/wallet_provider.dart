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

  Future<void> fund(double amount) async {
    state = const AsyncValue.loading();
    try {
      final repository = ref.read(walletRepositoryProvider);
      await repository.fundWallet(amount);
      final wallet = await _fetchWallet();
      state = AsyncValue.data(wallet);
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
}

final walletControllerProvider = AsyncNotifierProvider<WalletController, Wallet>(() => WalletController());
