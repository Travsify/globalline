
import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../../../core/network/api_client.dart';
import '../../data/repositories/profile_repository.dart';
import '../../../auth/data/models/auth_models.dart';
import '../../../auth/presentation/providers/auth_state.dart'; // Reuse auth state or create new one? Let's use simplified state.

class ProfileState {
  final bool isLoading;
  final String? error;
  final String? successMessage;

  const ProfileState({this.isLoading = false, this.error, this.successMessage});

  ProfileState copyWith({bool? isLoading, String? error, String? successMessage}) {
    return ProfileState(
      isLoading: isLoading ?? this.isLoading,
      error: error,
      successMessage: successMessage,
    );
  }
}

final profileRepositoryProvider = Provider<ProfileRepository>((ref) {
  final dio = ref.watch(dioProvider);
  return RealProfileRepository(dio);
});

class ProfileController extends Notifier<ProfileState> {
  late final ProfileRepository _repository;

  @override
  ProfileState build() {
    _repository = ref.watch(profileRepositoryProvider);
    return const ProfileState();
  }

  Future<bool> updateProfile(String name, String? phone, String? businessName, String? businessType) async {
    state = state.copyWith(isLoading: true, error: null, successMessage: null);
    try {
      await _repository.updateProfile(name, phone, businessName, businessType);
      state = state.copyWith(isLoading: false, successMessage: 'Profile updated successfully');
      return true;
    } catch (e) {
      state = state.copyWith(isLoading: false, error: e.toString());
      return false;
    }
  }

  Future<bool> changePassword(String currentPassword, String newPassword, String newPasswordConfirmation) async {
    state = state.copyWith(isLoading: true, error: null, successMessage: null);
    try {
      await _repository.changePassword(currentPassword, newPassword, newPasswordConfirmation);
      state = state.copyWith(isLoading: false, successMessage: 'Password changed successfully');
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

final profileControllerProvider = NotifierProvider<ProfileController, ProfileState>(ProfileController.new);
