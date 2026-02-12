import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/marketplace/data/models/product_model.dart';
import 'package:mobile/features/marketplace/data/repositories/marketplace_repository.dart';

import 'package:mobile/features/marketplace/presentation/providers/currency_provider.dart';
import 'package:mobile/features/marketplace/presentation/providers/marketplace_repository_provider.dart';

final productSearchProvider = FutureProvider.autoDispose.family<List<Product>, String>((ref, query) async {
  final repository = ref.watch(marketplaceRepositoryProvider);
  final currency = ref.watch(selectedCurrencyProvider);
  return repository.searchProducts(query, currency: currency);
});

final productDetailsProvider = FutureProvider.autoDispose.family<Product, String>((ref, id) async {
  final repository = ref.watch(marketplaceRepositoryProvider);
  final currency = ref.watch(selectedCurrencyProvider);
  return repository.getProductDetails(id, currency: currency);
});
