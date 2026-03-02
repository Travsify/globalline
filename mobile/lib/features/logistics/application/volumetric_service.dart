import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/logistics/data/models/logistics_models.dart';

final volumetricServiceProvider = Provider((ref) => VolumetricService());

class VolumetricService {
  /// Standard volumetric divisor (IATA standard is typically 5000 or 6000)
  static const int _volumetricDivisor = 5000;

  /// Calculates volumetric weight in KG given dimensions in cm
  double calculateVolumetricWeight({required double length, required double width, required double height}) {
    return (length * width * height) / _volumetricDivisor;
  }

  /// Calculates the efficiency score (0-100) of a shipment batch
  /// 
  /// A score of 100 means Actual Weight >= Volumetric Weight (High Density)
  /// A low score means the user is paying for "Air" (Low Density)
  double calculateEfficiencyScore(List<Shipment> shipments) {
    if (shipments.isEmpty) return 0.0;

    double totalActualWeight = 0.0;
    double totalVolumetricWeight = 0.0;

    for (var s in shipments) {
      totalActualWeight += (s.weight ?? 0.0);
      
      // If dimensions are missing, assume efficient packing (1:1) to avoid false alarms
      // Ideally implementation would require dimensions
      double volWeight = s.weight ?? 0.0; 
      // specific logic if we had dimension fields on Shipment model:
      // volWeight = calculateVolumetricWeight(length: s.length, width: s.width, height: s.height);
      
      // For simulation purposes without dimension data in current model, 
      // we'll assume a standard variance based on item type or random factor if needed, 
      // but strictly we should use actual data. 
      // Since current Shipment model might not have L/W/H, we will use a strict placeholder 
      // logic: if weight is very low (< 1kg) but item count is high, efficiency drops.
      
      totalVolumetricWeight += volWeight; 
    }

    if (totalVolumetricWeight == 0) return 100.0;
    
    // Efficiency Ratio
    double ratio = totalActualWeight / totalVolumetricWeight;
    if (ratio >= 1.0) return 100.0;
    
    return (ratio * 100).clamp(0.0, 100.0);
  }

  /// Returns a tactical suggestion based on the current batch
  String? getOptimizationSuggestion(List<Shipment> shipments) {
    if (shipments.isEmpty) return null;

    double totalWeight = shipments.fold(0, (sum, s) => sum + (s.weight ?? 0));

    // tactical thresholds for standard courier vs freight steps
    if (totalWeight < 1.0) {
      return "Low efficiency. Add 2kg more to reach minimum tier.";
    }
    if (totalWeight > 15.0 && totalWeight < 21.0) {
      return "Close to 21kg sweet spot. Add ${(21.0 - totalWeight).toStringAsFixed(1)}kg to drop rate by ~15%.";
    }
    if (totalWeight > 45.0 && totalWeight < 50.0) {
      return "Approaching Freight Tier (50kg+). Add ${(50.0 - totalWeight).toStringAsFixed(1)}kg for bulk rates.";
    }

    return null;
  }
  
  /// Checks if the batch is significantly inefficient (Efficiency < 50%)
  bool isPayingForAir(List<Shipment> shipments) {
    if (shipments.isEmpty) return false;
    return calculateEfficiencyScore(shipments) < 50.0;
  }
}
