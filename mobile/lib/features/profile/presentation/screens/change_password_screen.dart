
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../providers/profile_provider.dart';

class ChangePasswordScreen extends ConsumerStatefulWidget {
  const ChangePasswordScreen({super.key});

  @override
  ConsumerState<ChangePasswordScreen> createState() => _ChangePasswordScreenState();
}

class _ChangePasswordScreenState extends ConsumerState<ChangePasswordScreen> {
  final _formKey = GlobalKey<FormState>();
  final _currentPasswordController = TextEditingController();
  final _newPasswordController = TextEditingController();
  final _confirmPasswordController = TextEditingController();

  @override
  void dispose() {
    _currentPasswordController.dispose();
    _newPasswordController.dispose();
    _confirmPasswordController.dispose();
    super.dispose();
  }

  Future<void> _submit() async {
    if (_formKey.currentState!.validate()) {
      if (_newPasswordController.text != _confirmPasswordController.text) {
        ScaffoldMessenger.of(context).showSnackBar(const SnackBar(content: Text('Passwords do not match')));
        return;
      }

      final success = await ref.read(profileControllerProvider.notifier).changePassword(
        _currentPasswordController.text,
        _newPasswordController.text,
        _confirmPasswordController.text,
      );

      if (success && mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Password changed successfully')),
        );
        context.pop();
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final state = ref.watch(profileControllerProvider);

    return Scaffold(
      appBar: AppBar(title: const Text('Change Password')),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Form(
          key: _formKey,
          child: Column(
            children: [
              if (state.error != null)
                Padding(
                  padding: const EdgeInsets.only(bottom: 16),
                  child: Text(state.error!, style: const TextStyle(color: Colors.red)),
                ),
              TextFormField(
                controller: _currentPasswordController,
                decoration: const InputDecoration(labelText: 'Current Password'),
                obscureText: true,
                validator: (v) => v!.isEmpty ? 'Current password is required' : null,
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _newPasswordController,
                decoration: const InputDecoration(labelText: 'New Password'),
                obscureText: true,
                validator: (v) => v!.length < 8 ? 'Password must be at least 8 characters' : null,
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _confirmPasswordController,
                decoration: const InputDecoration(labelText: 'Confirm New Password'),
                obscureText: true,
                validator: (v) => v!.isEmpty ? 'Please confirm new password' : null,
              ),
              const SizedBox(height: 24),
              ElevatedButton(
                onPressed: state.isLoading ? null : _submit,
                child: state.isLoading ? const CircularProgressIndicator() : const Text('Change Password'),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
