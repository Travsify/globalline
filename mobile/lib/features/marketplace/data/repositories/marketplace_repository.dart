import 'package:dio/dio.dart';
import 'package:mobile/features/marketplace/data/models/product_model.dart';

abstract class MarketplaceRepository {
  Future<List<Product>> searchProducts(String query);
  Future<Product> getProductDetails(String id);
}

class RealMarketplaceRepository implements MarketplaceRepository {
  final Dio _dio;

  RealMarketplaceRepository(this._dio);

  @override
  Future<List<Product>> searchProducts(String query) async {
    try {
      final response = await _dio.get('/marketplace/products', queryParameters: {'query': query});
      return (response.data['products'] as List)
          .map((e) => Product.fromJson(e))
          .toList();
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<Product> getProductDetails(String id) async {
    try {
      final response = await _dio.get('/marketplace/products/$id');
      return Product.fromJson(response.data);
    } on DioException catch (e) {
      throw e.error!;
    }
  }
}
