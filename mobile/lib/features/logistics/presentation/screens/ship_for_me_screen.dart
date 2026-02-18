import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/logistics/presentation/providers/logistics_provider.dart';

class ShipForMeScreen extends ConsumerStatefulWidget {
  const ShipForMeScreen({super.key});

  @override
  ConsumerState<ShipForMeScreen> createState() => _ShipForMeScreenState();
}

class _ShipForMeScreenState extends ConsumerState<ShipForMeScreen> {
  final _formKey = GlobalKey<FormState>();
  final _trackingController = TextEditingController();
  final _itemNameController = TextEditingController();
  final _quantityController = TextEditingController();
  final _notesController = TextEditingController();
  bool _isLoading = false;

  @override
  void dispose() {
    _trackingController.dispose();
    _itemNameController.dispose();
    _quantityController.dispose();
    _notesController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF002366),
      appBar: AppBar(
        title: const Text('Ship for Me', 
          style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(24),
        child: Form(
          key: _formKey,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              const Text(
                "Provide details of the items you've purchased, and we'll handle the rest once they arrive at our warehouse.",
                style: TextStyle(color: Colors.white70, fontSize: 14),
              ),
              const SizedBox(height: 32),
              _buildTextField(_trackingController, "External Tracking ID", Icons.tag),
              const SizedBox(height: 16),
              _buildTextField(_itemNameController, "Item Name", Icons.shopping_bag_outlined),
              const SizedBox(height: 16),
              _buildTextField(_quantityController, "Quantity", Icons.numbers, inputType: TextInputType.number),
              const SizedBox(height: 16),
              _buildTextField(_notesController, "Additional Notes", Icons.note_alt_outlined, maxLines: 3),
              const SizedBox(height: 40),
              ElevatedButton(
                onPressed: _isLoading ? null : _submit,
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFFFFD700),
                  foregroundColor: const Color(0xFF002366),
                  padding: const EdgeInsets.symmetric(vertical: 18),
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                ),
                child: _isLoading 
                  ? const CircularProgressIndicator()
                  : const Text("SUBMIT REQUEST", style: TextStyle(fontWeight: FontWeight.bold)),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildTextField(TextEditingController controller, String label, IconData icon, {TextInputType inputType = TextInputType.text, int maxLines = 1}) {
    return TextFormField(
      controller: controller,
      keyboardType: inputType,
      maxLines: maxLines,
      style: const TextStyle(color: Colors.white),
      decoration: InputDecoration(
        labelText: label,
        labelStyle: TextStyle(color: Colors.white.withOpacity(0.6)),
        prefixIcon: Icon(icon, color: Colors.white.withOpacity(0.6)),
        filled: true,
        fillColor: Colors.white.withOpacity(0.1),
        border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
        enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide(color: Colors.white.withOpacity(0.1))),
        focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: const BorderSide(color: Color(0xFFFFD700))),
      ),
      validator: (val) => val!.isEmpty ? 'Required' : null,
    );
  }

  void _submit() async {
    if (_formKey.currentState!.validate()) {
      setState(() => _isLoading = true);
      try {
        final repo = ref.read(logisticsRepositoryProvider);
        await repo.shipForMe(
          externalTracking: _trackingController.text,
          itemName: _itemNameController.text,
          quantity: int.parse(_quantityController.text),
          notes: _notesController.text,
        );
        
        if (mounted) {
           showDialog(
            context: context,
            builder: (ctx) => AlertDialog(
              backgroundColor: const Color(0xFF002366),
              title: const Text("Request Received", style: TextStyle(color: Color(0xFFFFD700))),
              content: const Text("We've noted your package. You'll be notified once it hits our warehouse.", style: TextStyle(color: Colors.white)),
              actions: [
                TextButton(onPressed: () => context.go('/home'), child: const Text("OK", style: TextStyle(color: Colors.white))),
              ],
            ),
          );
        }
      } catch (e) {
        if (mounted) ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text("Error: $e")));
      } finally {
        if (mounted) setState(() => _isLoading = false);
      }
    }
  }
}
