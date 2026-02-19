import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/logistics/presentation/providers/logistics_provider.dart';
import 'package:mobile/features/logistics/data/models/logistics_models.dart';
import 'package:mobile/shared/widgets/status_widgets.dart';

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
              Expanded(
                child: eligibleShipments.isEmpty 
                  ? _buildEmptyState()
                  : _buildShipmentGrid(eligibleShipments),
              ),
              _buildActionFooter(),
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

  Widget _buildActionFooter() {
    return Container(
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: Colors.black.withOpacity(0.4),
        border: Border(top: BorderSide(color: Colors.white.withOpacity(0.1))),
      ),
      child: Column(
        children: [
          if (_totalWeight > 0 && _totalWeight < 10) 
            _buildOptimizationTip("Add 2.4kg more to unlock Wholesale Rates (7% off)"),
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
