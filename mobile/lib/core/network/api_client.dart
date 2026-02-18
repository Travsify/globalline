
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
      baseUrl: 'https://globalline.onrender.com/api/', 
      connectTimeout: const Duration(seconds: 30),
      receiveTimeout: const Duration(seconds: 30),
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'bypass-tunnel-reminder': 'true',
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
      
      // Defensive check: if we expect JSON but get something else (like an HTML string)
      if (response.requestOptions.responseType == ResponseType.json || 
          response.headers.value('content-type')?.contains('application/json') == true) {
        if (response.data is! Map && response.data is! List) {
          return handler.reject(DioException(
            requestOptions: response.requestOptions,
            response: response,
            type: DioExceptionType.badResponse,
            error: ResponseException('Server returned invalid data format. Expected JSON.'),
          ));
        }
      }
      return handler.next(response);
    },
    onError: (DioException e, handler) {
      ref.read(loggerProvider).e('Error: ${e.message}');
      if (e.response != null) {
        ref.read(loggerProvider).e('Response body: ${e.response?.data}');
        ref.read(loggerProvider).e('Response headers: ${e.response?.headers}');
      }
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
