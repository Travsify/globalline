import 'dart:io';
import 'package:dio/dio.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';
import 'package:mobile/features/kyc/data/models/kyc_model.dart';

abstract class KycRepository {
  Future<List<KycVerification>> getVerifications();
  Future<KycVerification> uploadKyc(String idType, String idNumber, File document);
  Future<String> getKycStatus();
}

class RealKycRepository implements KycRepository {
  final Dio _dio;
  RealKycRepository(this._dio);

  @override
  Future<List<KycVerification>> getVerifications() async {
    final response = await _dio.get('/kyc/verifications');
    return (response.data as List).map((e) => KycVerification.fromJson(e)).toList();
  }

  @override
  Future<KycVerification> uploadKyc(String idType, String idNumber, File document) async {
    final formData = FormData.fromMap({
      'id_type': idType,
      'id_number': idNumber,
      'document': await MultipartFile.fromFile(document.path),
    });

    final response = await _dio.post('/kyc/upload', data: formData);
    return KycVerification.fromJson(response.data);
  }

  @override
  Future<String> getKycStatus() async {
    final response = await _dio.get('/kyc/status');
    return response.data['status'] ?? 'none';
  }
}

final kycRepositoryProvider = Provider<KycRepository>((ref) {
  return RealKycRepository(ref.watch(dioProvider));
});

final kycVerificationsProvider = FutureProvider.autoDispose<List<KycVerification>>((ref) async {
  return ref.watch(kycRepositoryProvider).getVerifications();
});

final kycStatusProvider = FutureProvider.autoDispose<String>((ref) async {
  return ref.watch(kycRepositoryProvider).getKycStatus();
});
