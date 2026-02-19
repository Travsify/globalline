import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/marketplace/data/repositories/marketplace_repository.dart';
import 'package:mobile/features/marketplace/presentation/providers/marketplace_repository_provider.dart';
import 'package:mobile/features/marketplace/presentation/providers/marketplace_provider.dart';

class CreateSourcingRequestScreen extends ConsumerStatefulWidget {
  const CreateSourcingRequestScreen({super.key});

  @override
  ConsumerState<CreateSourcingRequestScreen> createState() => _CreateSourcingRequestScreenState();
}

class _CreateSourcingRequestScreenState extends ConsumerState<CreateSourcingRequestScreen> {
  final _formKey = GlobalKey<FormState>();
  final _nameController = TextEditingController();
  final _descController = TextEditingController();
  final _priceController = TextEditingController();
  final _qtyController = TextEditingController();
  final _deadlineController = TextEditingController();
  String _selectedOrigin = 'China';
  bool _isLoading = false;

  final List<String> _origins = ['China', 'Turkey', 'UAE', 'Other'];

  @override
  void dispose() {
    _nameController.dispose();
    _descController.dispose();
    _priceController.dispose();
    _qtyController.dispose();
    _deadlineController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF002366),
      appBar: AppBar(
        title: const Text('New Sourcing Request', 
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
                "Can't find it? Describe the product, and our global sourcing nodes in China, Turkey, and UAE will find it for you.",
                style: TextStyle(color: Colors.white70, fontSize: 14),
              ),
              const SizedBox(height: 32),
              _buildTextField(_nameController, "Product Name", Icons.label_important_outline),
              const SizedBox(height: 16),
              _buildTextField(_descController, "Detailed Description (Specs/Materials)", Icons.description_outlined, maxLines: 3),
              const SizedBox(height: 16),
              Row(
                children: [
                  Expanded(child: _buildTextField(_priceController, "Target Price (e.g. $2.50)", Icons.monetization_on_outlined)),
                  const SizedBox(width: 16),
                  Expanded(child: _buildTextField(_qtyController, "Target Quantity", Icons.production_quantity_limits_outlined)),
                ],
              ),
              const SizedBox(height: 16),
              Row(
                children: [
                  Expanded(child: _buildTextField(_deadlineController, "Deadline (YYYY-MM-DD)", Icons.calendar_today_outlined)),
                  const SizedBox(width: 16),
                  Expanded(child: _buildOriginDropdown()),
                ],
              ),
              const SizedBox(height: 48),
              ElevatedButton(
                onPressed: _isLoading ? null : _submit,
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFFFFD700),
                  foregroundColor: const Color(0xFF002366),
                  padding: const EdgeInsets.symmetric(vertical: 18),
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                  elevation: 5,
                ),
                child: _isLoading 
                  ? const SizedBox(height: 20, width: 20, child: CircularProgressIndicator(strokeWidth: 2))
                  : const Text("INITIALIZE SOURCING NODE", style: TextStyle(fontWeight: FontWeight.bold, letterSpacing: 1.2)),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildOriginDropdown() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text("Preferred Origin", style: TextStyle(color: Colors.white.withOpacity(0.6), fontSize: 12)),
        const SizedBox(height: 8),
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 12),
          decoration: BoxDecoration(
            color: Colors.white.withOpacity(0.1),
            borderRadius: BorderRadius.circular(16),
            border: Border.all(color: Colors.white.withOpacity(0.1)),
          ),
          child: DropdownButtonHideUnderline(
            child: DropdownButton<String>(
              value: _selectedOrigin,
              dropdownColor: const Color(0xFF001A4D),
              isExpanded: true,
              style: const TextStyle(color: Colors.white),
              items: _origins.map((String origin) {
                return DropdownMenuItem<String>(
                  value: origin,
                  child: Text(origin),
                );
              }).toList(),
              onChanged: (val) => setState(() => _selectedOrigin = val!),
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildTextField(TextEditingController controller, String label, IconData icon, {int maxLines = 1}) {
    return TextFormField(
      controller: controller,
      maxLines: maxLines,
      style: const TextStyle(color: Colors.white),
      decoration: InputDecoration(
        labelText: label,
        labelStyle: TextStyle(color: Colors.white.withOpacity(0.6), fontSize: 12),
        prefixIcon: Icon(icon, color: Colors.white.withOpacity(0.6), size: 18),
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
        final repo = ref.read(marketplaceRepositoryProvider);
        await repo.submitSourcingRequest(
          productName: _nameController.text,
          description: _descController.text,
          targetPrice: _priceController.text,
          quantity: _qtyController.text,
          preferredOrigin: _selectedOrigin,
          deadline: _deadlineController.text,
        );
        
        if (mounted) {
           ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(content: Text("Sourcing request submitted! Agents are searching global nodes.")),
          );
          ref.invalidate(sourcingRequestsProvider);
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
