import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../providers/auth_provider.dart';

class ForgotPasswordScreen extends ConsumerStatefulWidget {
  const ForgotPasswordScreen({super.key});

  @override
  ConsumerState<ForgotPasswordScreen> createState() => _ForgotPasswordScreenState();
}

class _ForgotPasswordScreenState extends ConsumerState<ForgotPasswordScreen> with SingleTickerProviderStateMixin {
  final _emailController = TextEditingController();
  final _otpController = TextEditingController();
  final _passwordController = TextEditingController();
  final _confirmPasswordController = TextEditingController();
  final _formKey = GlobalKey<FormState>();
  
  int _currentStep = 1; // 1: Email, 2: OTP, 3: New Password
  
  late AnimationController _animationController;

  @override
  void initState() {
    super.initState();
    _animationController = AnimationController(
        vsync: this, duration: const Duration(milliseconds: 1000));
    _animationController.forward();
  }

  @override
  void dispose() {
    _animationController.dispose();
    _emailController.dispose();
    _otpController.dispose();
    _passwordController.dispose();
    _confirmPasswordController.dispose();
    super.dispose();
  }

  Future<void> _handleNext() async {
    if (!_formKey.currentState!.validate()) return;

    final auth = ref.read(authControllerProvider.notifier);

    if (_currentStep == 1) {
      final success = await auth.forgotPassword(_emailController.text);
      if (success) {
        setState(() => _currentStep = 2);
      }
    } else if (_currentStep == 2) {
      final success = await auth.verifyOtp(_emailController.text, _otpController.text);
      if (success) {
        setState(() => _currentStep = 3);
      }
    } else if (_currentStep == 3) {
      final success = await auth.resetPassword(
        _emailController.text, 
        _otpController.text, 
        _passwordController.text, 
        _confirmPasswordController.text
      );
      if (success && mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text("Password reset successful!")),
        );
        context.pop();
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final state = ref.watch(authControllerProvider);
    
    return Scaffold(
      backgroundColor: const Color(0xFF002366),
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        backgroundColor: Colors.transparent,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios, color: Colors.white),
          onPressed: () {
            if (_currentStep > 1) {
              setState(() => _currentStep--);
            } else {
              context.pop();
            }
          },
        ),
      ),
      body: Stack(
        children: [
          Positioned.fill(
            child: Container(
              decoration: const BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                  colors: [Color(0xFF002366), Color(0xFF001540)],
                ),
              ),
            ),
          ),
          
          SafeArea(
            child: Center(
              child: SingleChildScrollView(
                padding: const EdgeInsets.all(24.0),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: [
                    _buildStepIcon(),
                    const SizedBox(height: 32),
                    Text(
                      _getStepTitle(),
                      style: const TextStyle(fontSize: 28, fontWeight: FontWeight.bold, color: Colors.white),
                      textAlign: TextAlign.center,
                    ),
                    const SizedBox(height: 16),
                    Text(
                      _getStepSubtitle(),
                      textAlign: TextAlign.center,
                      style: TextStyle(color: Colors.white.withOpacity(0.7), fontSize: 16),
                    ),
                    const SizedBox(height: 48),

                    if (state.error != null)
                      Padding(
                        padding: const EdgeInsets.only(bottom: 24),
                        child: Text(state.error!, style: const TextStyle(color: Colors.redAccent, fontSize: 12), textAlign: TextAlign.center),
                      ),

                    Form(
                      key: _formKey,
                      child: _buildStepFields(),
                    ),

                    const SizedBox(height: 32),
                    _buildActionButton(state.isLoading),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildStepIcon() {
    IconData icon = Icons.lock_reset;
    if (_currentStep == 2) icon = Icons.mark_email_unread;
    if (_currentStep == 3) icon = Icons.vpn_key;

    return Container(
      width: 100,
      height: 100,
      decoration: BoxDecoration(shape: BoxShape.circle, color: Colors.white.withOpacity(0.05)),
      child: Icon(icon, size: 48, color: const Color(0xFFFFD700)),
    );
  }

  String _getStepTitle() {
    if (_currentStep == 2) return "Verify Code";
    if (_currentStep == 3) return "New Password";
    return "Forgot Password?";
  }

  String _getStepSubtitle() {
    if (_currentStep == 2) return "Enter the 6-digit verification code sent to your emailHub.";
    if (_currentStep == 3) return "Create a secure new password for your GlobalLine account.";
    return "Enter your email address to receive a verification code.";
  }

  Widget _buildStepFields() {
    if (_currentStep == 2) {
      return TextFormField(
        controller: _otpController,
        style: const TextStyle(color: Colors.white),
        keyboardType: TextInputType.number,
        maxLength: 6,
        decoration: _getInputDecoration('Verification Code', Icons.numbers),
        validator: (v) => v!.length != 6 ? 'Enter 6-digit code' : null,
      );
    }
    
    if (_currentStep == 3) {
      return Column(
        children: [
          TextFormField(
            controller: _passwordController,
            style: const TextStyle(color: Colors.white),
            obscureText: true,
            decoration: _getInputDecoration('New Password', Icons.lock_outline),
            validator: (v) => v!.length < 8 ? 'Min 8 characters' : null,
          ),
          const SizedBox(height: 20),
          TextFormField(
            controller: _confirmPasswordController,
            style: const TextStyle(color: Colors.white),
            obscureText: true,
            decoration: _getInputDecoration('Confirm Password', Icons.lock_outline),
            validator: (v) => v != _passwordController.text ? 'Passwords do not match' : null,
          ),
        ],
      );
    }

    return TextFormField(
      controller: _emailController,
      style: const TextStyle(color: Colors.white),
      decoration: _getInputDecoration('Email Address', Icons.email_outlined),
      validator: (v) => v!.isEmpty ? 'Please enter your email' : null,
    );
  }

  InputDecoration _getInputDecoration(String label, IconData icon) {
    return InputDecoration(
      labelText: label,
      labelStyle: TextStyle(color: Colors.white.withOpacity(0.6)),
      prefixIcon: Icon(icon, color: Colors.white.withOpacity(0.6)),
      filled: true,
      fillColor: Colors.white.withOpacity(0.05),
      border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
      enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide(color: Colors.white.withOpacity(0.1))),
      focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: const BorderSide(color: Color(0xFFFFD700), width: 1.5)),
    );
  }

  Widget _buildActionButton(bool isLoading) {
    String label = "SEND CODE";
    if (_currentStep == 2) label = "VERIFY CODE";
    if (_currentStep == 3) label = "RESET PASSWORD";

    return Container(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(16),
        gradient: const LinearGradient(colors: [Color(0xFFFFD700), Color(0xFFFFA000)]),
        boxShadow: [BoxShadow(color: const Color(0xFFFFD700).withOpacity(0.3), blurRadius: 20, offset: const Offset(0, 5))],
      ),
      child: ElevatedButton(
        onPressed: isLoading ? null : _handleNext,
        style: ElevatedButton.styleFrom(
          backgroundColor: Colors.transparent,
          shadowColor: Colors.transparent,
          padding: const EdgeInsets.symmetric(vertical: 16),
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        ),
        child: isLoading 
          ? const SizedBox(height: 20, width: 20, child: CircularProgressIndicator(strokeWidth: 2, color: Color(0xFF002366)))
          : Text(label, style: const TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: Color(0xFF002366), letterSpacing: 1)),
      ),
    );
  }
}
