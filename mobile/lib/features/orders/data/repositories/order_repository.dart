import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/orders/data/models/order_model.dart';

abstract class OrderRepository {
  Future<List<Order>> getOrders();
}

class MockOrderRepository implements OrderRepository {
  @override
  Future<List<Order>> getOrders() async {
    await Future.delayed(const Duration(seconds: 1));
    return [
      Order(
        id: "ORD-2024-001",
        date: "2024-03-10",
        total: 250.00,
        status: OrderStatus.processing,
        itemsCount: 3,
        previewImage: "https://via.placeholder.com/150",
      ),
      Order(
        id: "ORD-2024-002",
        date: "2024-03-01",
        total: 120.50,
        status: OrderStatus.shipped,
        itemsCount: 1,
        previewImage: "https://via.placeholder.com/150",
      ),
      Order(
        id: "ORD-2024-003",
        date: "2024-02-15",
        total: 540.00,
        status: OrderStatus.delivered,
        itemsCount: 5,
        previewImage: "https://via.placeholder.com/150",
      ),
    ];
  }
}

final orderRepositoryProvider = Provider<OrderRepository>((ref) {
  return MockOrderRepository();
});

final ordersProvider = FutureProvider.autoDispose<List<Order>>((ref) async {
  final repository = ref.watch(orderRepositoryProvider);
  return repository.getOrders();
});
