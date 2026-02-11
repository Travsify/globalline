
enum OrderStatus { pending, processing, shipped, delivered, cancelled }

class Order {
  final String id;
  final String date;
  final double total;
  final OrderStatus status;
  final int itemsCount;
  final String previewImage;

  Order({
    required this.id,
    required this.date,
    required this.total,
    required this.status,
    required this.itemsCount,
    required this.previewImage,
  });
}
