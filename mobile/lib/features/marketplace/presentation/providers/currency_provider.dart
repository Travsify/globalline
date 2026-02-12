import 'package:flutter_riverpod/flutter_riverpod.dart';

final selectedCurrencyProvider = StateProvider<String>((ref) => 'USD');

final availableCurrenciesProvider = Provider<List<String>>((ref) => ['USD', 'NGN', 'TRY']);
