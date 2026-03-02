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
  final _urlController = TextEditingController();
  final _itemNameController = TextEditingController();
  final _quantityController = TextEditingController();
  final _notesController = TextEditingController();
  
  String _selectedWarehouse = 'Guangzhou, China 🇨🇳';
  bool _isLoading = false;

  final List<String> _warehouses = [
    'Guangzhou, China 🇨🇳',
    'Istanbul, Turkey 🇹🇷',
    'Dubai, UAE 🇦🇪',
    'Hong Kong 🇭🇰',
  ];

  @override
  void dispose() {
    _urlController.dispose();
    _itemNameController.dispose();
    _quantityController.dispose();
    _notesController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF001540),
      appBar: AppBar(
        title: const Text('Shop For Me', 
          style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            _buildHeaderPanel(),
            Padding(
              padding: const EdgeInsets.all(24),
              child: Form(
                key: _formKey,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: [
                    _buildSectionHeader("SERVICE TYPE"),
                    const SizedBox(height: 12),
                    _buildWarehouseSelector(),
                    const SizedBox(height: 32),
                    _buildSectionHeader("ITEM DETAILS"),
                    const SizedBox(height: 12),
                    _buildTextField(_urlController, "Product URL (1688, Taobao, Tmall, etc.)", Icons.link, hint: "Paste link for our agents to buy"),
                    const SizedBox(height: 16),
                    _buildTextField(_itemNameController, "Item Name / Description", Icons.shopping_bag_outlined),
                    const SizedBox(height: 16),
                    Row(
                      children: [
                        Expanded(child: _buildTextField(_quantityController, "Quantity", Icons.numbers, inputType: TextInputType.number)),
                        const SizedBox(width: 16),
                        Expanded(child: _buildInfoTag("Verified Node", Icons.verified_user_outlined)),
                      ],
                    ),
                    const SizedBox(height: 16),
                    _buildTextField(_notesController, "Variation / Specs (Size, Color)", Icons.edit_note, maxLines: 2),
                    const SizedBox(height: 48),
                    _buildSubmitButton(),
                    const SizedBox(height: 24),
                    _buildTrustSignals(),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildHeaderPanel() {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        border: Border(bottom: BorderSide(color: Colors.white.withOpacity(0.1))),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            "Concierge Buying",
            style: TextStyle(color: Color(0xFFFFD700), fontSize: 20, fontWeight: FontWeight.bold, fontFamily: 'Outfit'),
          ),
          const SizedBox(height: 8),
          Text(
            "Copy any product link from top China/Turkey sites. Our local agents will buy, inspect, and consolidate for you.",
            style: TextStyle(color: Colors.white.withOpacity(0.6), fontSize: 13, height: 1.4),
          ),
        ],
      ),
    );
  }

  Widget _buildSectionHeader(String title) {
    return Text(
      title,
      style: TextStyle(color: Colors.white.withOpacity(0.4), fontSize: 11, fontWeight: FontWeight.bold, letterSpacing: 1.5),
    );
  }

  Widget _buildWarehouseSelector() {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 16),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: Colors.white.withOpacity(0.1)),
      ),
      child: DropdownButtonHideUnderline(
        child: DropdownButton<String>(
          value: _selectedWarehouse,
          dropdownColor: const Color(0xFF001540),
          isExpanded: true,
          icon: const Icon(Icons.keyboard_arrow_down, color: Color(0xFFFFD700)),
          style: const TextStyle(color: Colors.white, fontWeight: FontWeight.w500),
          items: _warehouses.map((String value) {
            return DropdownMenuItem<String>(
              value: value,
              child: Text(value),
            );
          }).toList(),
          onChanged: (val) => setState(() => _selectedWarehouse = val!),
        ),
      ),
    );
  }

  Widget _buildTextField(TextEditingController controller, String label, IconData icon, {TextInputType inputType = TextInputType.text, int maxLines = 1, String? hint}) {
    return TextFormField(
      controller: controller,
      keyboardType: inputType,
      maxLines: maxLines,
      style: const TextStyle(color: Colors.white),
      decoration: InputDecoration(
        labelText: label,
        hintText: hint,
        hintStyle: TextStyle(color: Colors.white.withOpacity(0.3), fontSize: 13),
        labelStyle: TextStyle(color: Colors.white.withOpacity(0.6), fontSize: 12),
        prefixIcon: Icon(icon, color: const Color(0xFFFFD700).withOpacity(0.7), size: 20),
        filled: true,
        fillColor: Colors.white.withOpacity(0.05),
        border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
        enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide(color: Colors.white.withOpacity(0.1))),
        focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: const BorderSide(color: Color(0xFFFFD700))),
      ),
      validator: (val) => val!.isEmpty ? 'Required' : null,
    );
  }

  Widget _buildInfoTag(String label, IconData icon) {
    return Container(
      padding: const EdgeInsets.symmetric(vertical: 18),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.02),
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: Colors.white.withOpacity(0.05)),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(icon, color: Colors.greenAccent, size: 16),
          const SizedBox(width: 8),
          Text(label, style: const TextStyle(color: Colors.white38, fontSize: 12)),
        ],
      ),
    );
  }

  Widget _buildSubmitButton() {
    return ElevatedButton(
      onPressed: _isLoading ? null : _submit,
      style: ElevatedButton.styleFrom(
        backgroundColor: const Color(0xFFFFD700),
        foregroundColor: const Color(0xFF001540),
        padding: const EdgeInsets.symmetric(vertical: 20),
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
        elevation: 10,
        shadowColor: const Color(0xFFFFD700).withOpacity(0.3),
      ),
      child: _isLoading 
        ? const SizedBox(height: 20, width: 20, child: CircularProgressIndicator(strokeWidth: 2, color: Color(0xFF001540)))
        : const Text("START PURCHASE ORDER", style: TextStyle(fontWeight: FontWeight.bold, letterSpacing: 1.1)),
    );
  }

  Widget _buildTrustSignals() {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceAround,
      children: [
        _TrustItem(icon: Icons.security, label: "Secure Payment"),
        _TrustItem(icon: Icons.fact_check_outlined, label: "Quality Check"),
        _TrustItem(icon: Icons.speed, label: "Fast Transit"),
      ],
    );
  }

  void _submit() async {
    if (_formKey.currentState!.validate()) {
      setState(() => _isLoading = true);
      try {
        final repo = ref.read(logisticsRepositoryProvider);
        await repo.shipForMe(
          externalTracking: _urlController.text, // Re-purposing or backend-dependent
          itemName: _itemNameController.text,
          quantity: int.tryParse(_quantityController.text) ?? 1,
          notes: "Warehouse: $_selectedWarehouse | ${_notesController.text}",
        );
        
        if (mounted) {
           ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
              backgroundColor: Colors.greenAccent,
              content: Text("Request Activated! Our agents will review the item and provide a quote.", style: TextStyle(color: Colors.black, fontWeight: FontWeight.bold)),
            ),
          );
          context.pop();
        }
      } catch (e) {
        if (mounted) ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text("Error: $e")));
      } finally {
        if (mounted) setState(() => _isLoading = false);
      }
    }
  }
}

class _TrustItem extends StatelessWidget {
  final IconData icon;
  final String label;
  const _TrustItem({required this.icon, required this.label});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Icon(icon, color: Colors.white24, size: 20),
        const SizedBox(height: 6),
        Text(label, style: const TextStyle(color: Colors.white24, fontSize: 10)),
      ],
    );
  }
}
