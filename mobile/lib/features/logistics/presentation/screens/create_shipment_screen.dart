import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/logistics/presentation/providers/logistics_provider.dart';

class CreateShipmentScreen extends ConsumerStatefulWidget {
  const CreateShipmentScreen({super.key});

  @override
  ConsumerState<CreateShipmentScreen> createState() => _CreateShipmentScreenState();
}

class _CreateShipmentScreenState extends ConsumerState<CreateShipmentScreen> with SingleTickerProviderStateMixin {
  final _formKey = GlobalKey<FormState>();
  
  // Sender Details
  final _senderNameController = TextEditingController();
  final _senderPhoneController = TextEditingController();
  final _originController = TextEditingController();

  // Receiver Details
  final _receiverNameController = TextEditingController();
  final _receiverPhoneController = TextEditingController();
  final _destinationController = TextEditingController();

  // Package Details
  final _weightController = TextEditingController();
  final _descriptionController = TextEditingController();
  
  String _selectedService = "GlobalLine Standard";
  bool _isLoading = false;

  late AnimationController _controller;
  late Animation<double> _fadeAnimation;
  late Animation<Offset> _slideAnimation;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
        duration: const Duration(milliseconds: 800), vsync: this);
    _fadeAnimation = CurvedAnimation(parent: _controller, curve: Curves.easeIn);
    _slideAnimation = Tween<Offset>(begin: const Offset(0, 0.1), end: Offset.zero)
        .animate(CurvedAnimation(parent: _controller, curve: Curves.easeOut));
    _controller.forward();
  }

  @override
  void dispose() {
    _controller.dispose();
    _senderNameController.dispose();
    _senderPhoneController.dispose();
    _originController.dispose();
    _receiverNameController.dispose();
    _receiverPhoneController.dispose();
    _destinationController.dispose();
    _weightController.dispose();
    _descriptionController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF002366),
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        title: const Text('New Shipment', style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        centerTitle: true,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios, color: Colors.white),
          onPressed: () => context.pop(),
        ),
      ),
      body: Stack(
        children: [
          // Background Gradient
          Positioned.fill(
             child: Container(
              decoration: const BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                  colors: [
                    Color(0xFF002366),
                    Color(0xFF001540),
                  ],
                ),
              ),
            ),
          ),
          SafeArea(
            child: SingleChildScrollView(
              padding: const EdgeInsets.all(24.0),
              child: FadeTransition(
                opacity: _fadeAnimation,
                child: SlideTransition(
                  position: _slideAnimation,
                  child: Form(
                    key: _formKey,
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.stretch,
                      children: [
                        _buildSectionContainer(
                          title: "Sender Details",
                          icon: Icons.person_pin_circle_outlined,
                          children: [
                            _buildTextField(_senderNameController, "Sender Name", Icons.person),
                            const SizedBox(height: 16),
                            _buildTextField(_senderPhoneController, "Sender Phone", Icons.phone, inputType: TextInputType.phone),
                            const SizedBox(height: 16),
                            _buildTextField(_originController, "Origin Address", Icons.location_on),
                          ],
                        ),
                        const SizedBox(height: 24),
                        _buildSectionContainer(
                          title: "Receiver Details",
                          icon: Icons.person_pin_circle,
                          children: [
                            _buildTextField(_receiverNameController, "Receiver Name", Icons.person_outline),
                            const SizedBox(height: 16),
                            _buildTextField(_receiverPhoneController, "Receiver Phone", Icons.phone_android, inputType: TextInputType.phone),
                            const SizedBox(height: 16),
                            _buildTextField(_destinationController, "Destination Address", Icons.location_city),
                          ],
                        ),
                        const SizedBox(height: 24),
                        _buildSectionContainer(
                          title: "Package Info",
                          icon: Icons.inventory_2_outlined,
                          children: [
                             Row(
                                children: [
                                  Expanded(child: _buildTextField(_weightController, "Weight (kg)", Icons.scale, inputType: TextInputType.number)),
                                  const SizedBox(width: 16),
                                  Expanded(
                                    child: Container(
                                      padding: const EdgeInsets.symmetric(horizontal: 12),
                                      decoration: BoxDecoration(
                                        color: Colors.white.withOpacity(0.1),
                                        borderRadius: BorderRadius.circular(16),
                                        border: Border.all(color: Colors.white.withOpacity(0.1)),
                                      ),
                                      child: DropdownButtonHideUnderline(
                                        child: DropdownButton<String>(
                                          value: _selectedService,
                                          dropdownColor: const Color(0xFF001540),
                                          icon: const Icon(Icons.arrow_drop_down, color: Colors.white),
                                          style: const TextStyle(color: Colors.white, fontFamily: 'Outfit'),
                                          items: const [
                                            DropdownMenuItem(value: "GlobalLine Standard", child: Text("Standard")),
                                            DropdownMenuItem(value: "GlobalLine Express", child: Text("Express")),
                                          ],
                                          onChanged: (val) => setState(() => _selectedService = val!),
                                        ),
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                              const SizedBox(height: 16),
                              _buildTextField(_descriptionController, "Content Description", Icons.description),
                          ],
                        ),
                        const SizedBox(height: 32),
                        ElevatedButton(
                          onPressed: _isLoading ? null : _submitShipment,
                           style: ElevatedButton.styleFrom(
                                  backgroundColor: const Color(0xFFFFD700),
                                  foregroundColor: const Color(0xFF002366),
                                  padding: const EdgeInsets.symmetric(vertical: 18),
                                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                                  elevation: 5,
                                ),
                          child: _isLoading 
                            ? const SizedBox(width: 24, height: 24, child: CircularProgressIndicator(color: Color(0xFF002366)))
                            : const Text("CREATE SHIPMENT", style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, letterSpacing: 1)),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildSectionContainer({required String title, required IconData icon, required List<Widget> children}) {
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(24),
        border: Border.all(color: Colors.white.withOpacity(0.1)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Icon(icon, color: const Color(0xFFFFD700)),
              const SizedBox(width: 12),
              Text(
                title,
                style: const TextStyle(fontSize: 18, fontWeight: FontWeight.bold, color: Colors.white, fontFamily: 'Outfit'),
              ),
            ],
          ),
          Divider(color: Colors.white.withOpacity(0.1), height: 24),
          ...children,
        ],
      ),
    );
  }

  Widget _buildTextField(TextEditingController controller, String label, IconData icon, {TextInputType inputType = TextInputType.text}) {
    return TextFormField(
      controller: controller,
      keyboardType: inputType,
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
      validator: (value) => value!.isEmpty ? 'Required' : null,
    );
  }

  void _submitShipment() async {
    if (_formKey.currentState!.validate()) {
      setState(() => _isLoading = true);
      
      try {
        final repository = ref.read(logisticsRepositoryProvider);
        // Simulate delay
        await Future.delayed(const Duration(seconds: 2));
        final shipment = await repository.createShipment(
          origin: _originController.text,
          destination: _destinationController.text,
          weight: double.parse(_weightController.text),
          serviceName: _selectedService,
        );

        if (mounted) {
           setState(() => _isLoading = false);
          showDialog(
            context: context,
            barrierDismissible: false,
            builder: (ctx) => AlertDialog(
              backgroundColor: const Color(0xFF002366),
              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20), side: BorderSide(color: Colors.white.withOpacity(0.1))),
              title: const Text("Shipment Created!", style: TextStyle(color: Color(0xFFFFD700), fontWeight: FontWeight.bold, fontFamily: 'Outfit'), textAlign: TextAlign.center),
              content: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Container(
                    padding: const EdgeInsets.all(16),
                    decoration: BoxDecoration(
                      color: Colors.white.withOpacity(0.1),
                      shape: BoxShape.circle,
                    ),
                    child: const Icon(Icons.check_circle, color: Color(0xFFFFD700), size: 48),
                  ),
                  const SizedBox(height: 16),
                  Text("Tracking Number:\n${shipment.trackingNumber}", textAlign: TextAlign.center, style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 18, color: Colors.white)),
                ],
              ),
              actions: [
                TextButton(
                  onPressed: () {
                    Navigator.pop(ctx); // Close dialog
                    context.go('/tracking'); // Go to tracking
                  },
                  child: const Text("Track Now", style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                ),
                TextButton(
                  onPressed: () {
                     Navigator.pop(ctx); // Close dialog
                     context.go('/home'); // Go home
                  },
                  child: const Text("Done", style: TextStyle(color: Colors.white70)),
                ),
              ],
            ),
          );
        }
      } catch (e) {
        if (mounted) {
          setState(() => _isLoading = false);
          ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text("Error: $e")));
        }
      }
    }
  }
}
