
import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../../../core/network/api_client.dart';
import '../../data/repositories/supplier_payment_repository.dart';

// Simple state to hold list and loading status
class SupplierPaymentState {
  final bool isLoading;
  final String? error;
  final List<dynamic> payments;
  final String? successMessage;

  const SupplierPaymentState({
    this.isLoading = false,
    this.error,
    this.payments = const [],
    this.successMessage,
  });

  SupplierPaymentState copyWith({
    bool? isLoading,
    String? error,
    List<dynamic>? payments,
    String? successMessage,
  }) {
    return SupplierPaymentState(
      isLoading: isLoading ?? this.isLoading,
      error: error,
      payments: payments ?? this.payments,
      successMessage: successMessage,
    );
  }
}

final supplierPaymentRepositoryProvider = Provider<SupplierPaymentRepository>((ref) {
  final dio = ref.watch(dioProvider);
  return RealSupplierPaymentRepository(dio);
});

class SupplierPaymentController extends Notifier<SupplierPaymentState> {
  late final SupplierPaymentRepository _repository;

  @override
  SupplierPaymentState build() {
    _repository = ref.watch(supplierPaymentRepositoryProvider);
    return const SupplierPaymentState();
  }

  Future<void> fetchPayments() async {
    state = state.copyWith(isLoading: true, error: null);
    try {
      final payments = await _repository.getPayments();
      state = state.copyWith(isLoading: false, payments: payments);
    } catch (e) {
      state = state.copyWith(isLoading: false, error: e.toString());
    }
  }

  Future<bool> logPayment({
    required String supplierName,
    required double amount,
    required String currency,
    String? accountNumber,
    String? bankName,
    String? swiftCode,
    String? notes,
  }) async {
    state = state.copyWith(isLoading: true, error: null, successMessage: null);
    try {
      await _repository.logPayment(supplierName, amount, currency, accountNumber, bankName, swiftCode, notes);
      // Refresh list after successful log
      final updatedPayments = await _repository.getPayments();
      state = state.copyWith(
        isLoading: false, 
        successMessage: 'Payment logged successfully',
        payments: updatedPayments
      );
      return true;
    } catch (e) {
      state = state.copyWith(isLoading: false, error: e.toString());
      return false;
    }
  }

  void clearMessages() {
    state = state.copyWith(error: null, successMessage: null);
  }
}

final supplierPaymentControllerProvider = NotifierProvider<SupplierPaymentController, SupplierPaymentState>(SupplierPaymentController.new);
