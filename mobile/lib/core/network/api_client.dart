
import 'package:dio/dio.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:logger/logger.dart';
import '../exceptions/app_exceptions.dart';

import '../storage/secure_storage_service.dart';

final loggerProvider = Provider((ref) => Logger(
  printer: PrettyPrinter(methodCount: 0),
));

final dioProvider = Provider((ref) {
  final storage = ref.watch(secureStorageServiceProvider);
  
  final dio = Dio(
    BaseOptions(
      baseUrl: 'https://globalline-api-debug.loca.lt/api', 
      connectTimeout: const Duration(seconds: 30),
      receiveTimeout: const Duration(seconds: 30),
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      },
    ),
  );

  dio.interceptors.add(InterceptorsWrapper(
    onRequest: (options, handler) async {
      final token = await storage.getToken();
      if (token != null) {
        options.headers['Authorization'] = 'Bearer $token';
      }
      ref.read(loggerProvider).i('Request: ${options.method} ${options.path}');
      return handler.next(options);
    },
    onResponse: (response, handler) {
      ref.read(loggerProvider).i('Response: ${response.statusCode}');
      return handler.next(response);
    },
    onError: (DioException e, handler) {
      ref.read(loggerProvider).e('Error: ${e.message}');
      final exception = _mapDioError(e);
      return handler.next(DioException(
        requestOptions: e.requestOptions,
        error: exception,
        type: DioExceptionType.unknown,
      ));
    },
  ));

  return dio;
});

AppException _mapDioError(DioException error) {
  switch (error.type) {
    case DioExceptionType.connectionTimeout:
    case DioExceptionType.sendTimeout:
    case DioExceptionType.receiveTimeout:
    case DioExceptionType.connectionError:
      return NetworkException('Connection timed out. Please check your internet.');
    case DioExceptionType.badResponse:
      final statusCode = error.response?.statusCode;
      if (statusCode == 401) return UnauthenticatedException();
      if (statusCode == 422) {
        return ValidationException(
          error.response?.data['message'] ?? 'Validation error',
          error.response?.data['errors'],
        );
      }
      return ServerException(error.response?.data['message'] ?? 'Server error occurred');
    default:
      return AppException('An unexpected error occurred');
  }
}
