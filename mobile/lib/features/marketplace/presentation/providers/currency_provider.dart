import 'package:flutter_riverpod/flutter_riverpod.dart';

class SelectedCurrencyNotifier extends Notifier<String> {
  @override
  String build() => 'USD';

  void setCurrency(String currency) {
    state = currency;
  }
}

final selectedCurrencyProvider = NotifierProvider<SelectedCurrencyNotifier, String>(SelectedCurrencyNotifier.new);

final availableCurrenciesProvider = Provider<List<String>>((ref) => ['USD', 'NGN', 'TRY']);
