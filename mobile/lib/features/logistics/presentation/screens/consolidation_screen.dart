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
  final Set<String> _selectedShipmentIds = {};
  bool _isSubmitting = false;

  @override
  Widget build(BuildContext context) {
    final shipmentsAsync = ref.watch(userShipmentsProvider);

    return Scaffold(
      backgroundColor: const Color(0xFF002366),
      appBar: AppBar(
        title: const Text('Consolidate Shipments', 
          style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
      ),
      body: shipmentsAsync.when(
        data: (shipments) {
          final eligibleShipments = shipments.where((s) => s.status == 'pending').toList();
          
          if (eligibleShipments.isEmpty) {
            return const Center(
              child: Text("No shipments eligible for consolidation.", 
                style: TextStyle(color: Colors.white70)),
            );
          }

          return Column(
            children: [
              Expanded(
                child: ListView.builder(
                  padding: const EdgeInsets.all(16),
                  itemCount: eligibleShipments.length,
                  itemBuilder: (context, index) {
                    final shipment = eligibleShipments[index];
                    final isSelected = _selectedShipmentIds.contains(shipment.id);

                    return Card(
                      color: isSelected ? Colors.blue.withOpacity(0.2) : Colors.white.withOpacity(0.05),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(16),
                        side: BorderSide(
                          color: isSelected ? const Color(0xFFFFD700) : Colors.white.withOpacity(0.1),
                        ),
                      ),
                      child: CheckboxListTile(
                        title: Text(shipment.trackingNumber, 
                          style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                        subtitle: Text("${shipment.origin} -> ${shipment.destination}", 
                          style: const TextStyle(color: Colors.white70)),
                        value: isSelected,
                        onChanged: (val) {
                          setState(() {
                            if (val == true) {
                              _selectedShipmentIds.add(shipment.id);
                            } else {
                              _selectedShipmentIds.remove(shipment.id);
                            }
                          });
                        },
                        activeColor: const Color(0xFFFFD700),
                        checkColor: const Color(0xFF002366),
                      ),
                    );
                  },
                ),
              ),
              Padding(
                padding: const EdgeInsets.all(24.0),
                child: ElevatedButton(
                  onPressed: _selectedShipmentIds.length < 2 || _isSubmitting 
                    ? null 
                    : _submitConsolidation,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFFFFD700),
                    foregroundColor: const Color(0xFF002366),
                    minimumSize: const Size(double.infinity, 56),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                  ),
                  child: _isSubmitting 
                    ? const CircularProgressIndicator()
                    : Text("CONSOLIDATE ${_selectedShipmentIds.length} ITEMS"),
                ),
              ),
            ],
          );
        },
        loading: () => const AppLoadingWidget(),
        error: (err, stack) => AppErrorWidget(message: err.toString()),
      ),
    );
  }

  void _submitConsolidation() async {
    setState(() => _isSubmitting = true);
    try {
      final repo = ref.read(logisticsRepositoryProvider);
      await repo.consolidateShipments(_selectedShipmentIds.toList());
      
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text("Consolidation request submitted successfully!")),
        );
        ref.invalidate(userShipmentsProvider);
        context.pop();
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text("Error: $e")),
        );
      }
    } finally {
      if (mounted) setState(() => _isSubmitting = false);
    }
  }
}
