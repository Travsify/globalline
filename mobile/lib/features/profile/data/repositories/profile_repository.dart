
import 'package:dio/dio.dart';
import '../../../../core/network/api_client.dart';
import '../../../../features/auth/data/models/auth_models.dart';

abstract class ProfileRepository {
  Future<User> updateProfile(String name, String? phone, String? businessName, String? businessType);
  Future<void> changePassword(String currentPassword, String newPassword, String newPasswordConfirmation);
}

class RealProfileRepository implements ProfileRepository {
  final Dio _dio;

  RealProfileRepository(this._dio);

  @override
  Future<User> updateProfile(String name, String? phone, String? businessName, String? businessType) async {
    try {
      final response = await _dio.put('user/profile', data: {
        'name': name,
        'phone': phone,
        'business_name': businessName,
        'business_type': businessType,
      });

      return User.fromJson(response.data['user']);
    } on DioException catch (e) {
      throw e.error!;
    }
  }

  @override
  Future<void> changePassword(String currentPassword, String newPassword, String newPasswordConfirmation) async {
    try {
      await _dio.put('user/password', data: {
        'current_password': currentPassword,
        'new_password': newPassword,
        'new_password_confirmation': newPasswordConfirmation,
      });
    } on DioException catch (e) {
      throw e.error!;
    }
  }
}
