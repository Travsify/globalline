
import 'package:flutter/material.dart';
import 'package:dio/dio.dart';
import 'package:flutter_stripe/flutter_stripe.dart';
import 'package:flutter_paystack_plus/flutter_paystack_plus.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';

final paymentServiceProvider = Provider((ref) => PaymentService(ref.read(dioProvider)));

class PaymentService {
  final Dio _dio;

  PaymentService(this._dio);

  Future<void> initializePaystack(String publicKey) async {
    // Usually not needed for the static popup method, but we can store it or just let it be
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
    required BuildContext context,
    required String accessCode,
    required String reference,
    required String email,
    required double amount,
    required String publicKey, // Added publicKey
  }) async {
    await FlutterPaystackPlus.openPaystackPopup(
      publicKey: publicKey,
      context: context,
      secretKey: 'not_needed_for_client_side', // Usually just public key needed
      email: email,
      amount: (amount * 100).toInt().toString(), // String in kobo/cents usually
      ref: reference,
      onClosed: () {
        debugPrint('Paystack closed');
      },
      onSuccess: () {
        debugPrint('Paystack success');
      },
    );
  }
}
