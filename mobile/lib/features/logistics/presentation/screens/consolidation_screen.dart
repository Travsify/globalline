import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/logistics/presentation/providers/logistics_provider.dart';
import 'package:mobile/features/logistics/data/models/logistics_models.dart';
import 'package:mobile/shared/widgets/status_widgets.dart';
import 'package:mobile/features/logistics/application/volumetric_service.dart';

class ConsolidationScreen extends ConsumerStatefulWidget {
  const ConsolidationScreen({super.key});

  @override
  ConsumerState<ConsolidationScreen> createState() => _ConsolidationScreenState();
}

class _ConsolidationScreenState extends ConsumerState<ConsolidationScreen> {
  final Map<String, Shipment> _selectedShipments = {};
  bool _isSubmitting = false;

  double get _totalWeight => _selectedShipments.values.fold(0.0, (sum, item) => sum + (item.weight ?? 0.0));
  double get _estimatedSavings => _selectedShipments.length > 1 ? (_selectedShipments.length - 1) * 15.0 : 0.0; // Dynamic logic placeholder

  @override
  Widget build(BuildContext context) {
    final shipmentsAsync = ref.watch(userShipmentsProvider);
    final volumetricService = ref.read(volumetricServiceProvider);
    
    final selectedList = _selectedShipments.values.toList();
    final efficiencyScore = volumetricService.calculateEfficiencyScore(selectedList);
    final isPayingForAir = volumetricService.isPayingForAir(selectedList);
    final optimizationTip = volumetricService.getOptimizationSuggestion(selectedList);

    return Scaffold(
      backgroundColor: const Color(0xFF001540),
      appBar: AppBar(
        title: const Text('Global Aggregator', 
          style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold, letterSpacing: 1.2)),
        backgroundColor: Colors.transparent,
        elevation: 0,
      ),
      body: shipmentsAsync.when(
        data: (shipments) {
          final eligibleShipments = shipments.where((s) => s.status == 'pending').toList();
          
          return Column(
            children: [
              _buildAggregatorStats(),
              if (isPayingForAir) _buildVolumetricDefenderAlert(),
              _buildEfficiencyBar(efficiencyScore),
              Expanded(
                child: eligibleShipments.isEmpty 
                  ? _buildEmptyState()
                  : _buildShipmentGrid(eligibleShipments),
              ),
              _buildActionFooter(optimizationTip),
            ],
          );
        },
        loading: () => const AppLoadingWidget(),
        error: (err, stack) => AppErrorWidget(message: err.toString()),
      ),
    );
  }

  Widget _buildAggregatorStats() {
    return Container(
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        border: Border(bottom: BorderSide(color: Colors.white.withOpacity(0.1))),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: [
          _StatBlock(
            label: "AGGREGATED MASS",
            value: "${_totalWeight.toStringAsFixed(1)} KG",
            icon: Icons.monitor_weight_outlined,
            color: const Color(0xFFFFD700),
          ),
          _StatBlock(
            label: "EST. SAVINGS",
            value: "\$${_estimatedSavings.toStringAsFixed(0)}",
            icon: Icons.trending_down,
            color: Colors.greenAccent,
          ),
        ],
      ),
    );
  }

  Widget _buildEmptyState() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.inventory_2_outlined, size: 64, color: Colors.white.withOpacity(0.1)),
          const SizedBox(height: 16),
          const Text("No pending shipments found.", style: TextStyle(color: Colors.white30)),
        ],
      ),
    );
  }

  Widget _buildShipmentGrid(List<Shipment> shipments) {
    return GridView.builder(
      padding: const EdgeInsets.all(20),
      gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
        crossAxisCount: 2,
        crossAxisSpacing: 16,
        mainAxisSpacing: 16,
        childAspectRatio: 0.85,
      ),
      itemCount: shipments.length,
      itemBuilder: (context, index) {
        final shipment = shipments[index];
        final isSelected = _selectedShipments.containsKey(shipment.id);

        return GestureDetector(
          onTap: () => _toggleSelection(shipment),
          child: AnimatedContainer(
            duration: const Duration(milliseconds: 200),
            decoration: BoxDecoration(
              color: isSelected ? const Color(0xFFFFD700).withOpacity(0.1) : Colors.white.withOpacity(0.03),
              borderRadius: BorderRadius.circular(24),
              border: Border.all(
                color: isSelected ? const Color(0xFFFFD700) : Colors.white.withOpacity(0.05),
                width: isSelected ? 2 : 1,
              ),
            ),
            padding: const EdgeInsets.all(16),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(shipment.origin.toUpperCase(), 
                      style: const TextStyle(color: Colors.white30, fontSize: 10, fontWeight: FontWeight.bold)),
                    if (isSelected) const Icon(Icons.check_circle, color: Color(0xFFFFD700), size: 18),
                  ],
                ),
                Text(shipment.trackingNumber, 
                  maxLines: 1,
                  overflow: TextOverflow.ellipsis,
                  style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 14)),
                Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text("${shipment.weight ?? 0} KG", 
                      style: const TextStyle(color: Color(0xFFFFD700), fontWeight: FontWeight.w900, fontSize: 18)),
                    const Text("ITEM MASS", style: TextStyle(color: Colors.white24, fontSize: 8, fontWeight: FontWeight.bold)),
                  ],
                ),
              ],
            ),
          ),
        );
      },
    );
  }

  Widget _buildActionFooter(String? tip) {
    return Container(
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: Colors.black.withOpacity(0.4),
        border: Border(top: BorderSide(color: Colors.white.withOpacity(0.1))),
      ),
      child: Column(
        children: [
          if (tip != null) 
            _buildOptimizationTip(tip),
          const SizedBox(height: 16),
          ElevatedButton(
            onPressed: _selectedShipments.length < 2 || _isSubmitting 
              ? null 
              : _submitConsolidation,
            style: ElevatedButton.styleFrom(
              backgroundColor: const Color(0xFFFFD700),
              foregroundColor: const Color(0xFF001540),
              minimumSize: const Size(double.infinity, 60),
              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
              elevation: 0,
            ),
            child: _isSubmitting 
              ? const SizedBox(height: 20, width: 20, child: CircularProgressIndicator(strokeWidth: 2, color: Color(0xFF001540)))
              : Text("AGGREGATE ${_selectedShipments.length} SHIPMENTS", style: const TextStyle(fontWeight: FontWeight.bold, letterSpacing: 1.1)),
          ),
        ],
      ),
    );
  }

  Widget _buildVolumetricDefenderAlert() {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.redAccent.withOpacity(0.1),
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: Colors.redAccent.withOpacity(0.3)),
      ),
      child: Row(
        children: [
          const Icon(Icons.warning_amber_rounded, color: Colors.redAccent),
          const SizedBox(width: 12),
          const Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text("VOLUMETRIC DEFENDER DETECTED AIR", 
                  style: TextStyle(color: Colors.redAccent, fontSize: 10, fontWeight: FontWeight.bold, letterSpacing: 1)),
                SizedBox(height: 4),
                Text("You are paying for empty space. Add high-density small items (e.g., Phone Cases) to ship them for FREE.", 
                  style: TextStyle(color: Colors.white, fontSize: 12)),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildEfficiencyBar(double score) {
    final Color barColor = score > 80 ? Colors.greenAccent : (score > 50 ? const Color(0xFFFFD700) : Colors.orangeAccent);
    
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 8),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              const Text("SMART STACKING EFFICIENCY", style: TextStyle(color: Colors.white30, fontSize: 10, fontWeight: FontWeight.bold, letterSpacing: 1)),
              Text("${score.toInt()}%", style: TextStyle(color: barColor, fontWeight: FontWeight.bold, fontSize: 12)),
            ],
          ),
          const SizedBox(height: 8),
          ClipRRect(
            borderRadius: BorderRadius.circular(4),
            child: LinearProgressIndicator(
              value: score / 100,
              backgroundColor: Colors.white.withOpacity(0.05),
              valueColor: AlwaysStoppedAnimation<Color>(barColor),
              minHeight: 6,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildOptimizationTip(String text) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
      decoration: BoxDecoration(
        color: Colors.blueAccent.withOpacity(0.1),
        borderRadius: BorderRadius.circular(12),
      ),
      child: Row(
        children: [
          const Icon(Icons.lightbulb_outline, color: Colors.blueAccent, size: 14),
          const SizedBox(width: 8),
          Expanded(child: Text(text, style: const TextStyle(color: Colors.blueAccent, fontSize: 10, fontWeight: FontWeight.bold))),
        ],
      ),
    );
  }

  void _toggleSelection(Shipment shipment) {
    setState(() {
      if (_selectedShipments.containsKey(shipment.id)) {
        _selectedShipments.remove(shipment.id);
      } else {
        _selectedShipments[shipment.id] = shipment;
      }
    });
  }

  void _submitConsolidation() async {
    setState(() => _isSubmitting = true);
    try {
      final repo = ref.read(logisticsRepositoryProvider);
      await repo.consolidateShipments(_selectedShipments.keys.toList());
      
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            backgroundColor: Color(0xFFFFD700),
            content: Text("Consolidation sequence initiated!", style: TextStyle(color: Color(0xFF001540), fontWeight: FontWeight.bold)),
          ),
        );
        ref.invalidate(userShipmentsProvider);
        context.pop();
      }
    } catch (e) {
      if (mounted) ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text("Error: $e")));
    } finally {
      if (mounted) setState(() => _isSubmitting = false);
    }
  }
}

class _StatBlock extends StatelessWidget {
  final String label;
  final String value;
  final IconData icon;
  final Color color;

  const _StatBlock({required this.label, required this.value, required this.icon, required this.color});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Icon(icon, color: color.withOpacity(0.6), size: 20),
        const SizedBox(height: 8),
        Text(value, style: const TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.w900, fontFamily: 'Outfit')),
        Text(label, style: TextStyle(color: Colors.white.withOpacity(0.3), fontSize: 8, fontWeight: FontWeight.bold, letterSpacing: 1)),
      ],
    );
  }
}
