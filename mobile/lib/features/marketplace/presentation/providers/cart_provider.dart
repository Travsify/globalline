import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/marketplace/data/models/product_model.dart';

class CartItem {
  final Product product;
  final int quantity;

  CartItem({required this.product, required this.quantity});

  double get total => product.displayPrice * quantity;
  String get symbol => product.symbol;
}

class CartController extends Notifier<List<CartItem>> {
  @override
  List<CartItem> build() {
    return [];
  }

  void addToCart(Product product, int quantity) {
    if (state.any((item) => item.product.id == product.id)) {
      state = [
        for (final item in state)
          if (item.product.id == product.id)
            CartItem(product: product, quantity: item.quantity + quantity)
          else
            item
      ];
    } else {
      state = [...state, CartItem(product: product, quantity: quantity)];
    }
  }

  void removeFromCart(String productId) {
    state = state.where((item) => item.product.id != productId).toList();
  }

  void updateQuantity(String productId, int quantity) {
    state = [
      for (final item in state)
        if (item.product.id == productId)
          CartItem(product: item.product, quantity: quantity)
        else
          item
    ];
  }

  void clearCart() {
    state = [];
  }
}

final cartProvider = NotifierProvider<CartController, List<CartItem>>(CartController.new);

final cartTotalProvider = Provider<double>((ref) {
  final cart = ref.watch(cartProvider);
  return cart.fold(0, (sum, item) => sum + item.total);
});

final cartSymbolProvider = Provider<String>((ref) {
  final cart = ref.watch(cartProvider);
  return cart.isNotEmpty ? cart.first.symbol : r'$';
});
