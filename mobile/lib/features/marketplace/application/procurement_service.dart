import 'package:flutter_riverpod/flutter_riverpod.dart';

final procurementServiceProvider = Provider((ref) => ProcurementService());

class ProcurementService {
  /// Simulates fetching real-time market opportunities
  Future<List<MarketOpportunity>> checkMarketOpportunities() async {
    // Mock simulation of external API call
    await Future.delayed(const Duration(milliseconds: 800));
    return [
      MarketOpportunity(
        category: "Textiles",
        region: "Istanbul, TR",
        trend: -12.5,
        description: "Cotton prices dropped significantly due to surplus.",
      ),
      MarketOpportunity(
        category: "Electronics",
        region: "Shenzhen, CN",
        trend: 4.2,
        description: "Chip shortage stabilizing. Priority components available.",
        isPositive: true, // Price up implies demand/scarcity or just higher cost? usually we want drops. 
                          // Let's assume positive trend for buyer means "Good time to buy" or "Price Drop".
                          // Actually standard finance: -% is price drop (Good), +% is price hike (Bad).
                          // But for "Opportunity", we want to highlight favourable conditions.
                          // Let's stick to: Negative value = Price Drop (Good for buyer).
      ),
      MarketOpportunity(
        category: "Auto Parts",
        region: "Guangzhou, CN",
        trend: -8.0,
        description: "End-of-quarter clearance on suspension parts.",
      ),
    ];
  }

  /// Analyzes history to suggest re-stocks
  List<RestockSuggestion> predictReStockNeeds() {
    return [
      RestockSuggestion(
        itemName: "Brake Pads (Ceramic)",
        lastOrdered: DateTime.now().subtract(const Duration(days: 45)),
        averageCycleDays: 50,
        suggestedQuantity: 200,
        confidence: 0.85,
      ),
      RestockSuggestion(
        itemName: "Summer Linen Fabric",
        lastOrdered: DateTime.now().subtract(const Duration(days: 28)),
        averageCycleDays: 30,
        suggestedQuantity: 500,
        confidence: 0.92,
      ),
    ];
  }
}

class MarketOpportunity {
  final String category;
  final String region;
  final double trend; // Percentage change
  final String description;
  final bool isPositive; 

  // In this context, a negative trend (price drop) is POSITIVE for the buyer.
  bool get isGoodDeal => trend < 0;

  MarketOpportunity({
    required this.category,
    required this.region,
    required this.trend,
    required this.description,
    this.isPositive = false,
  });
}

class RestockSuggestion {
  final String itemName;
  final DateTime lastOrdered;
  final int averageCycleDays;
  final int suggestedQuantity;
  final double confidence;

  RestockSuggestion({
    required this.itemName,
    required this.lastOrdered,
    required this.averageCycleDays,
    required this.suggestedQuantity,
    required this.confidence,
  });
  
  int get daysUntilStockout => averageCycleDays - DateTime.now().difference(lastOrdered).inDays;
}
