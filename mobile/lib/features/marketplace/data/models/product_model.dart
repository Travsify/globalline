
class Product {
  final String id;
  final String title;
  final String imageUrl;
  final double price;
  final String currency;
  final String supplierName;
  final String moq;
  final String description;
  final List<String> images;

  Product({
    required this.id,
    required this.title,
    required this.imageUrl,
    required this.price,
    required this.currency,
    required this.supplierName,
    required this.moq,
    required this.description,
    required this.images,
  });

  factory Product.fromJson(Map<String, dynamic> json) {
    return Product(
      id: json['id'] as String,
      title: json['title'] as String,
      imageUrl: json['image_url'] as String,
      price: (json['price'] as num).toDouble(),
      currency: json['currency'] as String,
      supplierName: json['supplier_name'] as String,
      moq: json['moq'] as String,
      description: json['description'] as String,
      images: (json['images'] as List).map((e) => e as String).toList(),
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'title': title,
      'image_url': imageUrl,
      'price': price,
      'currency': currency,
      'supplier_name': supplierName,
      'moq': moq,
      'description': description,
      'images': images,
    };
  }
}
