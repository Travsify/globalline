
class Product {
  final String id;
  final String title;
  final String imageUrl;
  final double price; // Raw base
  final double baseUsdPrice; // Base + Markup
  final double displayPrice; // Converted display price
  final String symbol; // Currency symbol
  final String currency;
  final String supplierName;
  final String moq;
  final String description;
  final List<String> images;
  final String category;

  Product({
    required this.id,
    required this.title,
    required this.imageUrl,
    required this.price,
    required this.baseUsdPrice,
    required this.displayPrice,
    required this.symbol,
    required this.currency,
    required this.supplierName,
    required this.moq,
    required this.description,
    required this.images,
    required this.category,
  });

  factory Product.fromJson(Map<String, dynamic> json) {
    return Product(
      id: json['id'].toString(),
      title: json['title'] as String,
      imageUrl: json['image_url'] as String,
      price: (json['price'] as num).toDouble(),
      baseUsdPrice: (json['base_usd_price'] as num).toDouble(),
      displayPrice: (json['display_price'] as num).toDouble(),
      symbol: json['symbol'] as String? ?? '$',
      currency: json['currency'] as String,
      supplierName: json['supplier_name'] as String,
      moq: json['moq'] as String,
      description: json['description'] as String,
      images: (json['images'] as List).map((e) => e as String).toList(),
      category: json['category'] as String? ?? 'General',
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'title': title,
      'image_url': imageUrl,
      'price': price,
      'base_usd_price': baseUsdPrice,
      'display_price': displayPrice,
      'symbol': symbol,
      'currency': currency,
      'supplier_name': supplierName,
      'moq': moq,
      'description': description,
      'images': images,
      'category': category,
    };
  }
}
