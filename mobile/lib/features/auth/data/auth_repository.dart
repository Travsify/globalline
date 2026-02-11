
import 'package:dio/dio.dart';
import '../../../../core/network/api_client.dart';
import '../../../../core/storage/secure_storage_service.dart';
import './models/auth_models.dart';

abstract class AuthRepository {
  Future<AuthResponse> login(String email, String password);
  Future<void> register(String name, String email, String password);
  Future<void> logout();
}

class RealAuthRepository implements AuthRepository {
  final Dio _dio;
  final SecureStorageService _storage;

  RealAuthRepository(this._dio, this._storage);

  @override
  Future<AuthResponse> login(String email, String password) async {
    try {
      final response = await _dio.post('/auth/login', data: {
        'email': email,
        'password': password,
      });
      
      final authResponse = AuthResponse.fromJson(response.data);
      await _storage.saveToken(authResponse.token);
      return authResponse;
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> register(String name, String email, String password) async {
    try {
      final response = await _dio.post('/auth/register', data: {
        'name': name,
        'email': email,
        'password': password,
      });
      
      final authResponse = AuthResponse.fromJson(response.data);
      await _storage.saveToken(authResponse.token);
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> logout() async {
    await _storage.deleteToken();
  }
}
