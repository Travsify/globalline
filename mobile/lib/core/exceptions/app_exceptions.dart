
class AppException implements Exception {
  final String message;
  final String? code;

  AppException(this.message, [this.code]);

  @override
  String toString() => message;
}

class NetworkException extends AppException {
  NetworkException(String message) : super(message, 'network_error');
}

class UnauthenticatedException extends AppException {
  UnauthenticatedException() : super('Session expired. Please login again.', 'unauthenticated');
}

class ServerException extends AppException {
  ServerException(String message) : super(message, 'server_error');
}

class ValidationException extends AppException {
  final Map<String, dynamic>? errors;
  ValidationException(String message, [this.errors]) : super(message, 'validation_error');
}

class ResponseException extends AppException {
  ResponseException(String message) : super(message, 'response_error');
}
