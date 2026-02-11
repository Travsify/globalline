import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/marketplace/data/models/product_model.dart';
import 'package:mobile/features/marketplace/data/repositories/marketplace_repository.dart';

import 'package:mobile/features/marketplace/presentation/providers/marketplace_repository_provider.dart';

final productSearchProvider = FutureProvider.autoDispose.family<List<Product>, String>((ref, query) async {
  final repository = ref.watch(marketplaceRepositoryProvider);
  return repository.searchProducts(query);
});

final productDetailsProvider = FutureProvider.autoDispose.family<Product, String>((ref, id) async {
  final repository = ref.watch(marketplaceRepositoryProvider);
  return repository.getProductDetails(id);
});
