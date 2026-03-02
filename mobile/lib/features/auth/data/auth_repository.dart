import 'package:dio/dio.dart';
import '../../../../core/storage/secure_storage_service.dart';
import '../../../../core/exceptions/app_exceptions.dart';
import './models/auth_models.dart';

abstract class AuthRepository {
  Future<AuthResponse> login(String email, String password);
  Future<AuthResponse> register(String name, String email, String password, String passwordConfirmation);
  Future<void> logout();
  Future<void> forgotPassword(String email);
  Future<void> verifyOtp(String email, String otp);
  Future<void> resetPassword(String email, String otp, String password, String passwordConfirmation);
}

class RealAuthRepository implements AuthRepository {
  final Dio _dio;
  final SecureStorageService _storage;

  RealAuthRepository(this._dio, this._storage);

  @override
  Future<AuthResponse> login(String email, String password) async {
    try {
      final response = await _dio.post('auth/login', data: {
        'email': email,
        'password': password,
      });
      
      if (response.data is! Map<String, dynamic>) {
        throw ResponseException('Invalid response format from server');
      }
      
      final authResponse = AuthResponse.fromJson(response.data);
      await _storage.saveToken(authResponse.token);
      return authResponse;
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<AuthResponse> register(String name, String email, String password, String passwordConfirmation) async {
    try {
      final response = await _dio.post('auth/register', data: {
        'name': name,
        'email': email,
        'password': password,
        'password_confirmation': passwordConfirmation,
      });
      
      final authResponse = AuthResponse.fromJson(response.data);
      await _storage.saveToken(authResponse.token);
      return authResponse;
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> logout() async {
    await _storage.deleteToken();
  }

  @override
  Future<void> forgotPassword(String email) async {
    try {
      await _dio.post('auth/forgot-password', data: {
        'email': email,
      });
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> verifyOtp(String email, String otp) async {
    try {
      await _dio.post('auth/verify-otp', data: {
        'email': email,
        'otp': otp,
      });
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> resetPassword(String email, String otp, String password, String passwordConfirmation) async {
    try {
      await _dio.post('auth/reset-password', data: {
        'email': email,
        'otp': otp,
        'password': password,
        'password_confirmation': passwordConfirmation,
      });
    } on DioException catch (e) {
      throw e.error!;
    }
  }
}
