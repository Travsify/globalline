
import 'package:dio/dio.dart';
import 'package:flutter_stripe/flutter_stripe.dart';
import 'package:flutter_paystack_plus/flutter_paystack_plus.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';

final paymentServiceProvider = Provider((ref) => PaymentService(ref.read(apiClientProvider)));

class PaymentService {
  final Dio _dio;
  final PaystackPlugin _paystackPlugin = PaystackPlugin();

  PaymentService(this._dio);

  Future<void> initializePaystack(String publicKey) async {
    await _paystackPlugin.initialize(publicKey: publicKey);
  }

  Future<Map<String, dynamic>> initializePayment({
    required double amount,
    required String currency,
    required String gateway,
    required String email,
  }) async {
    try {
      final response = await _dio.post('payment/initialize', data: {
        'amount': amount,
        'currency': currency,
        'gateway': gateway,
        'email': email,
      });
      return response.data;
    } catch (e) {
      throw Exception('Failed to initialize payment: $e');
    }
  }

  Future<void> processStripePayment({
    required String clientSecret,
    required String publishableKey,
  }) async {
    Stripe.publishableKey = publishableKey;
    
    await Stripe.instance.initPaymentSheet(
      paymentSheetParameters: SetupPaymentSheetParameters(
        paymentIntentClientSecret: clientSecret,
        merchantDisplayName: 'GlobalLine',
      ),
    );

    await Stripe.instance.presentPaymentSheet();
  }

  Future<void> processPaystackPayment({
    required context,
    required String accessCode,
    required String reference,
    required String email,
    required double amount,
  }) async {
    final charge = Charge()
      ..amount = (amount * 100).toInt() // Kobo
      ..email = email
      ..accessCode = accessCode
      ..reference = reference;

    final response = await _paystackPlugin.checkout(
      context,
      charge: charge,
      method: CheckoutMethod.card,
    );

    if (!response.status) {
      throw Exception('Payment failed: ${response.message}');
    }
  }
}
