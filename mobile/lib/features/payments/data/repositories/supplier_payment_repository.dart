
import 'package:dio/dio.dart';

abstract class SupplierPaymentRepository {
  Future<List<dynamic>> getPayments(); // Using dynamic for now, ideally mapped to a Model
  Future<void> logPayment(String supplierName, double amount, String currency, String? accountNumber, String? bankName, String? swiftCode, String? notes);
}

class RealSupplierPaymentRepository implements SupplierPaymentRepository {
  final Dio _dio;

  RealSupplierPaymentRepository(this._dio);

  @override
  Future<List<dynamic>> getPayments() async {
    try {
      final response = await _dio.get('payments');
      // Pagination handling: response.data['data'] if paginated, else response.data
      if (response.data is Map && response.data.containsKey('data')) {
          return response.data['data'];
      }
      return response.data;
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> logPayment(String supplierName, double amount, String currency, String? accountNumber, String? bankName, String? swiftCode, String? notes) async {
    try {
      await _dio.post('payments', data: {
        'supplier_name': supplierName,
        'amount': amount,
        'currency': currency,
        'account_number': accountNumber,
        'bank_name': bankName,
        'swift_code': swiftCode,
        'notes': notes,
      });
    } on DioException catch (e) {
      throw e.error!;
    }
  }
}
