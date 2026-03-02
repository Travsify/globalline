import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/logistics/presentation/providers/logistics_provider.dart';
import 'package:mobile/features/auth/presentation/providers/auth_provider.dart';

// ─── Constants ───────────────────────────────────────────────────────────────
const _kNavy = Color(0xFF002366);
const _kNavyDark = Color(0xFF001540);
const _kGold = Color(0xFFFFD700);

const _kStepTitles = ['Route', 'Package', 'Contacts', 'Service', 'Review'];
const _kStepIcons = [
  Icons.route_outlined,
  Icons.inventory_2_outlined,
  Icons.people_alt_outlined,
  Icons.local_shipping_outlined,
  Icons.checklist_outlined,
];

const _kCountries = [
  'Nigeria', 'Ghana', 'Kenya', 'South Africa', 'UK',
  'USA', 'Canada', 'China', 'India', 'Germany',
  'France', 'UAE', 'Turkey', 'Japan', 'Brazil',
  'Egypt', 'Tanzania', 'Rwanda', 'Senegal', 'Cameroon',
];

const _kPackageTypes = [
  ('document', 'Document', Icons.description_outlined, '< 0.5 kg'),
  ('small_box', 'Small Box', Icons.shopping_bag_outlined, '< 5 kg'),
  ('medium_parcel', 'Medium Parcel', Icons.all_inbox_outlined, '5–30 kg'),
  ('large_cargo', 'Large Cargo', Icons.warehouse_outlined, '30+ kg'),
  ('custom', 'Custom', Icons.tune_outlined, 'Any size'),
];

// ─── Main Screen ─────────────────────────────────────────────────────────────
class CreateShipmentScreen extends ConsumerStatefulWidget {
  const CreateShipmentScreen({super.key});

  @override
  ConsumerState<CreateShipmentScreen> createState() => _CreateShipmentScreenState();
}

class _CreateShipmentScreenState extends ConsumerState<CreateShipmentScreen>
    with TickerProviderStateMixin {

  final _pageController = PageController();
  int _currentStep = 0;

  // Step 1 — Route
  String _originCountry = 'Nigeria';
  String _destinationCountry = 'UK';
  final _originCityCtrl = TextEditingController();
  final _destCityCtrl = TextEditingController();

  // Step 2 — Package
  String _packageType = 'small_box';
  final _weightCtrl = TextEditingController();
  final _lengthCtrl = TextEditingController();
  final _widthCtrl = TextEditingController();
  final _heightCtrl = TextEditingController();
  final _descriptionCtrl = TextEditingController();
  final _declaredValueCtrl = TextEditingController();

  // Step 3 — Contacts
  final _senderNameCtrl = TextEditingController();
  final _senderPhoneCtrl = TextEditingController();
  final _senderEmailCtrl = TextEditingController();
  final _receiverNameCtrl = TextEditingController();
  final _receiverPhoneCtrl = TextEditingController();
  final _receiverEmailCtrl = TextEditingController();

  // Step 4 — Service
  String _selectedService = 'GlobalLine Standard';
  bool _isInsured = false;

  bool _isLoading = false;
  bool _senderAutoFilled = false;

  final _formKeys = List.generate(4, (_) => GlobalKey<FormState>());

  late AnimationController _animController;
  late Animation<double> _fadeAnim;

  @override
  void initState() {
    super.initState();
    _animController = AnimationController(
      duration: const Duration(milliseconds: 600),
      vsync: this,
    );
    _fadeAnim = CurvedAnimation(parent: _animController, curve: Curves.easeIn);
    _animController.forward();
  }

  @override
  void dispose() {
    _animController.dispose();
    _pageController.dispose();
    _originCityCtrl.dispose();
    _destCityCtrl.dispose();
    _weightCtrl.dispose();
    _lengthCtrl.dispose();
    _widthCtrl.dispose();
    _heightCtrl.dispose();
    _descriptionCtrl.dispose();
    _declaredValueCtrl.dispose();
    _senderNameCtrl.dispose();
    _senderPhoneCtrl.dispose();
    _senderEmailCtrl.dispose();
    _receiverNameCtrl.dispose();
    _receiverPhoneCtrl.dispose();
    _receiverEmailCtrl.dispose();
    super.dispose();
  }

  // ─── Navigation ──────────────────────────────────────────────────────────
  void _goToStep(int step) {
    if (step < 0 || step > 4) return;

    // Validate current step before advancing
    if (step > _currentStep && _currentStep < 4) {
      if (!_formKeys[_currentStep].currentState!.validate()) return;
    }

    setState(() => _currentStep = step);
    _pageController.animateToPage(
      step,
      duration: const Duration(milliseconds: 350),
      curve: Curves.easeInOut,
    );
  }

  void _next() => _goToStep(_currentStep + 1);
  void _back() {
    if (_currentStep == 0) {
      context.pop();
    } else {
      _goToStep(_currentStep - 1);
    }
  }

  // ─── Auto-fill sender ────────────────────────────────────────────────────
  void _tryAutoFillSender() {
    if (_senderAutoFilled) return;
    try {
      final authState = ref.read(authControllerProvider);
      final user = authState.user;
      if (user != null) {
        if (_senderNameCtrl.text.isEmpty) {
          _senderNameCtrl.text = user.name;
        }
        if (_senderEmailCtrl.text.isEmpty) {
          _senderEmailCtrl.text = user.email;
        }
        _senderAutoFilled = true;
      }
    } catch (_) {
      // Silently ignore if auth provider not available
    }
  }

  // ─── Build ───────────────────────────────────────────────────────────────
  @override
  Widget build(BuildContext context) {
    return PopScope(
      canPop: _currentStep == 0,
      onPopInvokedWithResult: (didPop, _) {
        if (!didPop) _back();
      },
      child: Scaffold(
        backgroundColor: _kNavy,
        body: Container(
          decoration: const BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
              colors: [_kNavy, _kNavyDark],
            ),
          ),
          child: SafeArea(
            child: FadeTransition(
              opacity: _fadeAnim,
              child: Column(
                children: [
                  // ── Top Bar ──────────────────────────────────
                  _buildTopBar(),
                  const SizedBox(height: 8),
                  // ── Step Indicator ───────────────────────────
                  _buildStepIndicator(),
                  const SizedBox(height: 16),
                  // ── Page Content ─────────────────────────────
                  Expanded(
                    child: PageView(
                      controller: _pageController,
                      physics: const NeverScrollableScrollPhysics(),
                      children: [
                        _buildStep1Route(),
                        _buildStep2Package(),
                        _buildStep3Contacts(),
                        _buildStep4Service(),
                        _buildStep5Review(),
                      ],
                    ),
                  ),
                  // ── Bottom Nav Buttons ───────────────────────
                  _buildBottomButtons(),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  // ═══════════════════════════════════════════════════════════════════════════
  // TOP BAR
  // ═══════════════════════════════════════════════════════════════════════════
  Widget _buildTopBar() {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
      child: Row(
        children: [
          GestureDetector(
            onTap: _back,
            child: Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: Colors.white.withOpacity(0.1),
                borderRadius: BorderRadius.circular(12),
              ),
              child: const Icon(Icons.arrow_back_ios_new, color: Colors.white, size: 20),
            ),
          ),
          const Expanded(
            child: Text(
              'New Shipment',
              textAlign: TextAlign.center,
              style: TextStyle(
                color: Colors.white,
                fontSize: 20,
                fontWeight: FontWeight.bold,
                fontFamily: 'Outfit',
              ),
            ),
          ),
          const SizedBox(width: 40), // Balance
        ],
      ),
    );
  }

  // ═══════════════════════════════════════════════════════════════════════════
  // STEP INDICATOR
  // ═══════════════════════════════════════════════════════════════════════════
  Widget _buildStepIndicator() {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 16),
      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 12),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(20),
        border: Border.all(color: Colors.white.withOpacity(0.08)),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        children: List.generate(5, (i) {
          final isActive = i == _currentStep;
          final isCompleted = i < _currentStep;
          return GestureDetector(
            onTap: isCompleted ? () => _goToStep(i) : null,
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                AnimatedContainer(
                  duration: const Duration(milliseconds: 300),
                  width: 36,
                  height: 36,
                  decoration: BoxDecoration(
                    color: isActive
                        ? _kGold
                        : isCompleted
                            ? _kGold.withOpacity(0.3)
                            : Colors.white.withOpacity(0.08),
                    shape: BoxShape.circle,
                    border: Border.all(
                      color: isActive ? _kGold : Colors.transparent,
                      width: 2,
                    ),
                  ),
                  child: Icon(
                    isCompleted ? Icons.check : _kStepIcons[i],
                    size: 18,
                    color: isActive ? _kNavy : isCompleted ? _kNavy : Colors.white54,
                  ),
                ),
                const SizedBox(height: 4),
                Text(
                  _kStepTitles[i],
                  style: TextStyle(
                    fontSize: 10,
                    fontWeight: isActive ? FontWeight.bold : FontWeight.normal,
                    color: isActive ? _kGold : Colors.white54,
                    fontFamily: 'Outfit',
                  ),
                ),
              ],
            ),
          );
        }),
      ),
    );
  }

  // ═══════════════════════════════════════════════════════════════════════════
  // BOTTOM BUTTONS
  // ═══════════════════════════════════════════════════════════════════════════
  Widget _buildBottomButtons() {
    return Container(
      padding: const EdgeInsets.fromLTRB(20, 12, 20, 16),
      decoration: BoxDecoration(
        color: Colors.black.withOpacity(0.15),
        border: Border(top: BorderSide(color: Colors.white.withOpacity(0.06))),
      ),
      child: Row(
        children: [
          if (_currentStep > 0)
            Expanded(
              child: OutlinedButton.icon(
                onPressed: _back,
                icon: const Icon(Icons.arrow_back, size: 18),
                label: const Text('Back'),
                style: OutlinedButton.styleFrom(
                  foregroundColor: Colors.white,
                  side: BorderSide(color: Colors.white.withOpacity(0.3)),
                  padding: const EdgeInsets.symmetric(vertical: 14),
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
                ),
              ),
            ),
          if (_currentStep > 0) const SizedBox(width: 12),
          Expanded(
            flex: _currentStep == 0 ? 1 : 1,
            child: _currentStep == 4
                ? ElevatedButton.icon(
                    onPressed: _isLoading ? null : _submitShipment,
                    icon: _isLoading
                        ? const SizedBox(
                            width: 18,
                            height: 18,
                            child: CircularProgressIndicator(color: _kNavy, strokeWidth: 2),
                          )
                        : const Icon(Icons.check_circle, size: 20),
                    label: Text(_isLoading ? 'Creating...' : 'CONFIRM & SHIP'),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: _kGold,
                      foregroundColor: _kNavy,
                      padding: const EdgeInsets.symmetric(vertical: 14),
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
                      textStyle: const TextStyle(fontWeight: FontWeight.bold, letterSpacing: 0.5),
                    ),
                  )
                : ElevatedButton.icon(
                    onPressed: _next,
                    icon: const SizedBox.shrink(),
                    label: const Row(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        Text('Continue'),
                        SizedBox(width: 4),
                        Icon(Icons.arrow_forward, size: 18),
                      ],
                    ),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: _kGold,
                      foregroundColor: _kNavy,
                      padding: const EdgeInsets.symmetric(vertical: 14),
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
                      textStyle: const TextStyle(fontWeight: FontWeight.bold),
                    ),
                  ),
          ),
        ],
      ),
    );
  }

  // ═══════════════════════════════════════════════════════════════════════════
  // STEP 1 — ROUTE
  // ═══════════════════════════════════════════════════════════════════════════
  Widget _buildStep1Route() {
    return _stepScroll(
      formIndex: 0,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _sectionHeader('Where are you shipping?', Icons.route_outlined),
          const SizedBox(height: 20),
          // Origin
          _card(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                _labelRow(Icons.flight_takeoff, 'From', _kGold),
                const SizedBox(height: 12),
                _countryDropdown(
                  value: _originCountry,
                  onChanged: (v) => setState(() => _originCountry = v!),
                ),
                const SizedBox(height: 12),
                _textField(_originCityCtrl, 'City / Address', Icons.location_on_outlined),
              ],
            ),
          ),
          const SizedBox(height: 12),
          // Swap button
          Center(
            child: GestureDetector(
              onTap: () {
                setState(() {
                  final tmp = _originCountry;
                  _originCountry = _destinationCountry;
                  _destinationCountry = tmp;
                  final tmpCity = _originCityCtrl.text;
                  _originCityCtrl.text = _destCityCtrl.text;
                  _destCityCtrl.text = tmpCity;
                });
              },
              child: Container(
                padding: const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: _kGold,
                  shape: BoxShape.circle,
                  boxShadow: [
                    BoxShadow(color: _kGold.withOpacity(0.4), blurRadius: 12, offset: const Offset(0, 4)),
                  ],
                ),
                child: const Icon(Icons.swap_vert, color: _kNavy, size: 24),
              ),
            ),
          ),
          const SizedBox(height: 12),
          // Destination
          _card(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                _labelRow(Icons.flight_land, 'To', Colors.greenAccent),
                const SizedBox(height: 12),
                _countryDropdown(
                  value: _destinationCountry,
                  onChanged: (v) => setState(() => _destinationCountry = v!),
                ),
                const SizedBox(height: 12),
                _textField(_destCityCtrl, 'City / Address', Icons.location_city_outlined),
              ],
            ),
          ),
          if (_originCountry != _destinationCountry) ...[
            const SizedBox(height: 16),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 10),
              decoration: BoxDecoration(
                color: Colors.amber.withOpacity(0.1),
                borderRadius: BorderRadius.circular(12),
                border: Border.all(color: Colors.amber.withOpacity(0.3)),
              ),
              child: Row(
                children: [
                  const Icon(Icons.public, color: Colors.amber, size: 18),
                  const SizedBox(width: 8),
                  Expanded(
                    child: Text(
                      'International shipment — customs docs may be required',
                      style: TextStyle(color: Colors.amber.shade200, fontSize: 12),
                    ),
                  ),
                ],
              ),
            ),
          ],
        ],
      ),
    );
  }

  // ═══════════════════════════════════════════════════════════════════════════
  // STEP 2 — PACKAGE
  // ═══════════════════════════════════════════════════════════════════════════
  Widget _buildStep2Package() {
    return _stepScroll(
      formIndex: 1,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _sectionHeader('Package Details', Icons.inventory_2_outlined),
          const SizedBox(height: 16),
          // Package Type Presets
          const Text(
            'Package Type',
            style: TextStyle(color: Colors.white70, fontSize: 13, fontFamily: 'Outfit'),
          ),
          const SizedBox(height: 10),
          Wrap(
            spacing: 8,
            runSpacing: 8,
            children: _kPackageTypes.map((pt) {
              final isSelected = _packageType == pt.$1;
              return GestureDetector(
                onTap: () => setState(() => _packageType = pt.$1),
                child: AnimatedContainer(
                  duration: const Duration(milliseconds: 200),
                  padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 10),
                  decoration: BoxDecoration(
                    color: isSelected ? _kGold.withOpacity(0.15) : Colors.white.withOpacity(0.05),
                    borderRadius: BorderRadius.circular(14),
                    border: Border.all(
                      color: isSelected ? _kGold : Colors.white.withOpacity(0.1),
                      width: isSelected ? 1.5 : 1,
                    ),
                  ),
                  child: Row(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Icon(pt.$3, size: 18, color: isSelected ? _kGold : Colors.white54),
                      const SizedBox(width: 6),
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          Text(
                            pt.$2,
                            style: TextStyle(
                              color: isSelected ? Colors.white : Colors.white70,
                              fontSize: 12,
                              fontWeight: isSelected ? FontWeight.bold : FontWeight.normal,
                            ),
                          ),
                          Text(pt.$4, style: const TextStyle(color: Colors.white38, fontSize: 9)),
                        ],
                      ),
                    ],
                  ),
                ),
              );
            }).toList(),
          ),
          const SizedBox(height: 20),
          // Weight
          _card(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                _labelRow(Icons.scale, 'Weight & Dimensions', _kGold),
                const SizedBox(height: 12),
                _textField(
                  _weightCtrl, 'Weight (kg)', Icons.fitness_center_outlined,
                  inputType: TextInputType.numberWithOptions(decimal: true),
                ),
                if (_packageType == 'custom' || _packageType == 'large_cargo' || _packageType == 'medium_parcel') ...[
                  const SizedBox(height: 12),
                  Row(
                    children: [
                      Expanded(child: _textField(
                        _lengthCtrl, 'L (cm)', null,
                        inputType: TextInputType.number, isRequired: false,
                      )),
                      const SizedBox(width: 8),
                      Expanded(child: _textField(
                        _widthCtrl, 'W (cm)', null,
                        inputType: TextInputType.number, isRequired: false,
                      )),
                      const SizedBox(width: 8),
                      Expanded(child: _textField(
                        _heightCtrl, 'H (cm)', null,
                        inputType: TextInputType.number, isRequired: false,
                      )),
                    ],
                  ),
                ],
              ],
            ),
          ),
          const SizedBox(height: 16),
          _card(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                _labelRow(Icons.description_outlined, 'Contents', Colors.cyanAccent),
                const SizedBox(height: 12),
                _textField(_descriptionCtrl, 'Describe contents', Icons.short_text, maxLines: 2),
                const SizedBox(height: 12),
                _textField(
                  _declaredValueCtrl, 'Declared Value (USD)', Icons.attach_money,
                  inputType: TextInputType.numberWithOptions(decimal: true),
                  isRequired: false,
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  // ═══════════════════════════════════════════════════════════════════════════
  // STEP 3 — CONTACTS
  // ═══════════════════════════════════════════════════════════════════════════
  Widget _buildStep3Contacts() {
    _tryAutoFillSender();
    return _stepScroll(
      formIndex: 2,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _sectionHeader('Contact Details', Icons.people_alt_outlined),
          const SizedBox(height: 16),
          // Sender
          _card(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  children: [
                    const Icon(Icons.person, color: _kGold, size: 18),
                    const SizedBox(width: 8),
                    const Expanded(
                      child: Text('Sender', style: TextStyle(color: Colors.white, fontSize: 15, fontWeight: FontWeight.bold, fontFamily: 'Outfit')),
                    ),
                    if (_senderAutoFilled)
                      Container(
                        padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
                        decoration: BoxDecoration(
                          color: Colors.green.withOpacity(0.15),
                          borderRadius: BorderRadius.circular(8),
                        ),
                        child: const Text('Auto-filled', style: TextStyle(color: Colors.greenAccent, fontSize: 10)),
                      ),
                  ],
                ),
                const SizedBox(height: 12),
                _textField(_senderNameCtrl, 'Full Name', Icons.badge_outlined),
                const SizedBox(height: 10),
                _textField(_senderPhoneCtrl, 'Phone', Icons.phone_outlined, inputType: TextInputType.phone),
                const SizedBox(height: 10),
                _textField(_senderEmailCtrl, 'Email', Icons.email_outlined, inputType: TextInputType.emailAddress, isRequired: false),
              ],
            ),
          ),
          const SizedBox(height: 16),
          // Receiver
          _card(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                _labelRow(Icons.person_outline, 'Receiver', Colors.greenAccent),
                const SizedBox(height: 12),
                _textField(_receiverNameCtrl, 'Full Name', Icons.badge_outlined),
                const SizedBox(height: 10),
                _textField(_receiverPhoneCtrl, 'Phone', Icons.phone_outlined, inputType: TextInputType.phone),
                const SizedBox(height: 10),
                _textField(_receiverEmailCtrl, 'Email (for tracking updates)', Icons.email_outlined, inputType: TextInputType.emailAddress, isRequired: false),
              ],
            ),
          ),
        ],
      ),
    );
  }

  // ═══════════════════════════════════════════════════════════════════════════
  // STEP 4 — SERVICE
  // ═══════════════════════════════════════════════════════════════════════════
  Widget _buildStep4Service() {
    return _stepScroll(
      formIndex: 3,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _sectionHeader('Choose Service', Icons.local_shipping_outlined),
          const SizedBox(height: 16),
          // Standard
          _serviceCard(
            title: 'GlobalLine Standard',
            subtitle: '7–14 business days',
            price: 'From \$15',
            icon: Icons.inventory_2_outlined,
            isSelected: _selectedService == 'GlobalLine Standard',
            onTap: () => setState(() => _selectedService = 'GlobalLine Standard'),
          ),
          const SizedBox(height: 12),
          // Express
          _serviceCard(
            title: 'GlobalLine Express',
            subtitle: '3–5 business days',
            price: 'From \$35',
            icon: Icons.rocket_launch_outlined,
            isSelected: _selectedService == 'GlobalLine Express',
            onTap: () => setState(() => _selectedService = 'GlobalLine Express'),
            featured: true,
          ),
          const SizedBox(height: 24),
          // Insurance
          _card(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  children: [
                    const Icon(Icons.shield_outlined, color: _kGold, size: 20),
                    const SizedBox(width: 8),
                    const Expanded(
                      child: Text('Shipment Insurance', style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontFamily: 'Outfit')),
                    ),
                    Transform.scale(
                      scale: 0.85,
                      child: Switch.adaptive(
                        value: _isInsured,
                        onChanged: (v) => setState(() => _isInsured = v),
                        activeColor: _kGold,
                        inactiveThumbColor: Colors.white30,
                        inactiveTrackColor: Colors.white10,
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 4),
                Text(
                  _isInsured
                      ? 'Your package is insured against loss or damage up to declared value.'
                      : 'Enable to protect against loss or damage during transit.',
                  style: TextStyle(color: Colors.white.withOpacity(0.5), fontSize: 12),
                ),
                if (_isInsured) ...[
                  const SizedBox(height: 8),
                  Container(
                    padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                    decoration: BoxDecoration(
                      color: Colors.green.withOpacity(0.1),
                      borderRadius: BorderRadius.circular(10),
                    ),
                    child: const Row(
                      children: [
                        Icon(Icons.verified_user, color: Colors.greenAccent, size: 16),
                        SizedBox(width: 8),
                        Expanded(
                          child: Text(
                            'Premium: 2.5% of declared value (min \$3)',
                            style: TextStyle(color: Colors.greenAccent, fontSize: 11),
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ],
            ),
          ),
          const SizedBox(height: 16),
          // Pickup option
          _card(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                _labelRow(Icons.delivery_dining, 'How will we get it?', Colors.orangeAccent),
                const SizedBox(height: 12),
                Row(
                  children: [
                    _pickupChip('Drop-off', Icons.storefront_outlined, 'drop_off'),
                    const SizedBox(width: 10),
                    _pickupChip('Pickup', Icons.local_shipping_outlined, 'pickup'),
                  ],
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  String _pickupType = 'drop_off';

  Widget _pickupChip(String label, IconData icon, String value) {
    final isSelected = _pickupType == value;
    return Expanded(
      child: GestureDetector(
        onTap: () => setState(() => _pickupType = value),
        child: AnimatedContainer(
          duration: const Duration(milliseconds: 200),
          padding: const EdgeInsets.symmetric(vertical: 12),
          decoration: BoxDecoration(
            color: isSelected ? _kGold.withOpacity(0.15) : Colors.white.withOpacity(0.05),
            borderRadius: BorderRadius.circular(12),
            border: Border.all(
              color: isSelected ? _kGold : Colors.white.withOpacity(0.1),
            ),
          ),
          child: Column(
            children: [
              Icon(icon, color: isSelected ? _kGold : Colors.white54, size: 22),
              const SizedBox(height: 4),
              Text(
                label,
                style: TextStyle(
                  color: isSelected ? Colors.white : Colors.white54,
                  fontSize: 12,
                  fontWeight: isSelected ? FontWeight.bold : FontWeight.normal,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _serviceCard({
    required String title,
    required String subtitle,
    required String price,
    required IconData icon,
    required bool isSelected,
    required VoidCallback onTap,
    bool featured = false,
  }) {
    return GestureDetector(
      onTap: onTap,
      child: AnimatedContainer(
        duration: const Duration(milliseconds: 250),
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: isSelected ? _kGold.withOpacity(0.12) : Colors.white.withOpacity(0.05),
          borderRadius: BorderRadius.circular(18),
          border: Border.all(
            color: isSelected ? _kGold : Colors.white.withOpacity(0.1),
            width: isSelected ? 1.5 : 1,
          ),
        ),
        child: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(10),
              decoration: BoxDecoration(
                color: isSelected ? _kGold.withOpacity(0.2) : Colors.white.withOpacity(0.08),
                borderRadius: BorderRadius.circular(12),
              ),
              child: Icon(icon, color: isSelected ? _kGold : Colors.white54, size: 24),
            ),
            const SizedBox(width: 14),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    children: [
                      Flexible(
                        child: Text(
                          title,
                          style: TextStyle(
                            color: Colors.white,
                            fontWeight: FontWeight.bold,
                            fontFamily: 'Outfit',
                            fontSize: 14,
                          ),
                        ),
                      ),
                      if (featured) ...[
                        const SizedBox(width: 6),
                        Container(
                          padding: const EdgeInsets.symmetric(horizontal: 6, vertical: 2),
                          decoration: BoxDecoration(
                            color: _kGold.withOpacity(0.2),
                            borderRadius: BorderRadius.circular(6),
                          ),
                          child: const Text('FAST', style: TextStyle(color: _kGold, fontSize: 8, fontWeight: FontWeight.bold)),
                        ),
                      ],
                    ],
                  ),
                  const SizedBox(height: 2),
                  Text(subtitle, style: TextStyle(color: Colors.white.withOpacity(0.5), fontSize: 12)),
                ],
              ),
            ),
            Column(
              crossAxisAlignment: CrossAxisAlignment.end,
              children: [
                Text(price, style: TextStyle(color: isSelected ? _kGold : Colors.white70, fontWeight: FontWeight.bold, fontSize: 14, fontFamily: 'Outfit')),
                if (isSelected)
                  const Icon(Icons.check_circle, color: _kGold, size: 18),
              ],
            ),
          ],
        ),
      ),
    );
  }

  // ═══════════════════════════════════════════════════════════════════════════
  // STEP 5 — REVIEW
  // ═══════════════════════════════════════════════════════════════════════════
  Widget _buildStep5Review() {
    return SingleChildScrollView(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _sectionHeader('Review & Confirm', Icons.checklist_outlined),
          const SizedBox(height: 16),
          // Route
          _reviewSection(
            'Route',
            Icons.route_outlined,
            0,
            [
              _reviewRow('From', '$_originCountry — ${_originCityCtrl.text}'),
              _reviewRow('To', '$_destinationCountry — ${_destCityCtrl.text}'),
            ],
          ),
          const SizedBox(height: 12),
          // Package
          _reviewSection(
            'Package',
            Icons.inventory_2_outlined,
            1,
            [
              _reviewRow('Type', _packageType.replaceAll('_', ' ').toUpperCase()),
              _reviewRow('Weight', '${_weightCtrl.text} kg'),
              if (_lengthCtrl.text.isNotEmpty)
                _reviewRow('Dimensions', '${_lengthCtrl.text} × ${_widthCtrl.text} × ${_heightCtrl.text} cm'),
              if (_descriptionCtrl.text.isNotEmpty)
                _reviewRow('Contents', _descriptionCtrl.text),
              if (_declaredValueCtrl.text.isNotEmpty)
                _reviewRow('Declared Value', '\$${_declaredValueCtrl.text}'),
            ],
          ),
          const SizedBox(height: 12),
          // Contacts
          _reviewSection(
            'Contacts',
            Icons.people_alt_outlined,
            2,
            [
              _reviewRow('Sender', _senderNameCtrl.text),
              _reviewRow('Sender Phone', _senderPhoneCtrl.text),
              _reviewRow('Receiver', _receiverNameCtrl.text),
              _reviewRow('Receiver Phone', _receiverPhoneCtrl.text),
            ],
          ),
          const SizedBox(height: 12),
          // Service
          _reviewSection(
            'Service',
            Icons.local_shipping_outlined,
            3,
            [
              _reviewRow('Service', _selectedService),
              _reviewRow('Insurance', _isInsured ? 'Yes ✓' : 'No'),
              _reviewRow('Pickup', _pickupType == 'pickup' ? 'Door Pickup' : 'Drop-off'),
            ],
          ),
          const SizedBox(height: 20),
        ],
      ),
    );
  }

  Widget _reviewSection(String title, IconData icon, int stepIndex, List<Widget> rows) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(18),
        border: Border.all(color: Colors.white.withOpacity(0.08)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Icon(icon, color: _kGold, size: 18),
              const SizedBox(width: 8),
              Expanded(
                child: Text(title, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontFamily: 'Outfit')),
              ),
              GestureDetector(
                onTap: () => _goToStep(stepIndex),
                child: Container(
                  padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.08),
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: const Text('Edit', style: TextStyle(color: _kGold, fontSize: 11, fontWeight: FontWeight.bold)),
                ),
              ),
            ],
          ),
          Divider(color: Colors.white.withOpacity(0.08), height: 20),
          ...rows,
        ],
      ),
    );
  }

  Widget _reviewRow(String label, String value) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 3),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          SizedBox(
            width: 110,
            child: Text(label, style: TextStyle(color: Colors.white.withOpacity(0.5), fontSize: 12)),
          ),
          Expanded(
            child: Text(
              value.isEmpty ? '—' : value,
              style: const TextStyle(color: Colors.white, fontSize: 13, fontWeight: FontWeight.w500),
            ),
          ),
        ],
      ),
    );
  }

  // ═══════════════════════════════════════════════════════════════════════════
  // SUBMIT
  // ═══════════════════════════════════════════════════════════════════════════
  void _submitShipment() async {
    setState(() => _isLoading = true);

    try {
      final repository = ref.read(logisticsRepositoryProvider);
      final shipment = await repository.createShipment(
        origin: _originCityCtrl.text,
        originCountry: _originCountry,
        destination: _destCityCtrl.text,
        destinationCountry: _destinationCountry,
        weight: double.tryParse(_weightCtrl.text) ?? 0,
        serviceName: _selectedService,
        senderName: _senderNameCtrl.text,
        senderPhone: _senderPhoneCtrl.text,
        senderEmail: _senderEmailCtrl.text.isEmpty ? null : _senderEmailCtrl.text,
        receiverName: _receiverNameCtrl.text,
        receiverPhone: _receiverPhoneCtrl.text,
        receiverEmail: _receiverEmailCtrl.text.isEmpty ? null : _receiverEmailCtrl.text,
        description: _descriptionCtrl.text.isEmpty ? null : _descriptionCtrl.text,
        packageType: _packageType,
        length: double.tryParse(_lengthCtrl.text),
        width: double.tryParse(_widthCtrl.text),
        height: double.tryParse(_heightCtrl.text),
        declaredValue: double.tryParse(_declaredValueCtrl.text),
        isInsured: _isInsured,
        pickupType: _pickupType,
      );

      if (mounted) {
        setState(() => _isLoading = false);
        _showSuccessDialog(shipment.trackingNumber);
      }
    } catch (e) {
      if (mounted) {
        setState(() => _isLoading = false);
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Error: $e'),
            backgroundColor: Colors.redAccent,
          ),
        );
      }
    }
  }

  void _showSuccessDialog(String trackingNumber) {
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (ctx) => AlertDialog(
        backgroundColor: _kNavy,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(24),
          side: BorderSide(color: Colors.white.withOpacity(0.1)),
        ),
        title: Column(
          children: [
            Container(
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: _kGold.withOpacity(0.1),
                shape: BoxShape.circle,
              ),
              child: const Icon(Icons.check_circle_outline, color: _kGold, size: 48),
            ),
            const SizedBox(height: 16),
            const Text(
              'Shipment Created!',
              style: TextStyle(color: _kGold, fontWeight: FontWeight.bold, fontFamily: 'Outfit', fontSize: 20),
              textAlign: TextAlign.center,
            ),
          ],
        ),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Text(
              'Your tracking number is:',
              style: TextStyle(color: Colors.white.withOpacity(0.6), fontSize: 13),
            ),
            const SizedBox(height: 8),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
              decoration: BoxDecoration(
                color: Colors.white.withOpacity(0.08),
                borderRadius: BorderRadius.circular(12),
              ),
              child: Text(
                trackingNumber,
                style: const TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 20,
                  color: Colors.white,
                  letterSpacing: 2,
                  fontFamily: 'Outfit',
                ),
              ),
            ),
          ],
        ),
        actionsAlignment: MainAxisAlignment.center,
        actions: [
          TextButton.icon(
            onPressed: () {
              Navigator.pop(ctx);
              context.go('/tracking');
            },
            icon: const Icon(Icons.gps_fixed, size: 16),
            label: const Text('Track Now'),
            style: TextButton.styleFrom(
              foregroundColor: _kGold,
              textStyle: const TextStyle(fontWeight: FontWeight.bold),
            ),
          ),
          TextButton(
            onPressed: () {
              Navigator.pop(ctx);
              context.go('/home');
            },
            child: Text('Done', style: TextStyle(color: Colors.white.withOpacity(0.6))),
          ),
        ],
      ),
    );
  }

  // ═══════════════════════════════════════════════════════════════════════════
  // REUSABLE WIDGETS
  // ═══════════════════════════════════════════════════════════════════════════

  /// Wraps a step in a scrollable Form
  Widget _stepScroll({required int formIndex, required Widget child}) {
    return SingleChildScrollView(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
      child: Form(
        key: _formKeys[formIndex],
        child: child,
      ),
    );
  }

  Widget _sectionHeader(String text, IconData icon) {
    return Row(
      children: [
        Icon(icon, color: _kGold, size: 22),
        const SizedBox(width: 10),
        Expanded(
          child: Text(
            text,
            style: const TextStyle(
              color: Colors.white,
              fontSize: 20,
              fontWeight: FontWeight.bold,
              fontFamily: 'Outfit',
            ),
          ),
        ),
      ],
    );
  }

  Widget _card({required Widget child}) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(18),
        border: Border.all(color: Colors.white.withOpacity(0.08)),
      ),
      child: child,
    );
  }

  Widget _labelRow(IconData icon, String label, Color iconColor) {
    return Row(
      children: [
        Icon(icon, color: iconColor, size: 18),
        const SizedBox(width: 8),
        Text(
          label,
          style: const TextStyle(
            color: Colors.white,
            fontSize: 15,
            fontWeight: FontWeight.bold,
            fontFamily: 'Outfit',
          ),
        ),
      ],
    );
  }

  Widget _countryDropdown({required String value, required ValueChanged<String?> onChanged}) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 2),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.08),
        borderRadius: BorderRadius.circular(14),
        border: Border.all(color: Colors.white.withOpacity(0.1)),
      ),
      child: DropdownButtonHideUnderline(
        child: DropdownButton<String>(
          value: value,
          dropdownColor: _kNavyDark,
          icon: const Icon(Icons.arrow_drop_down, color: Colors.white54),
          isExpanded: true,
          style: const TextStyle(color: Colors.white, fontFamily: 'Outfit', fontSize: 14),
          items: _kCountries.map((c) => DropdownMenuItem(
            value: c,
            child: Row(
              children: [
                const Icon(Icons.flag_outlined, size: 16, color: Colors.white54),
                const SizedBox(width: 8),
                Text(c),
              ],
            ),
          )).toList(),
          onChanged: onChanged,
        ),
      ),
    );
  }

  Widget _textField(
    TextEditingController controller,
    String label,
    IconData? icon, {
    TextInputType inputType = TextInputType.text,
    bool isRequired = true,
    int maxLines = 1,
  }) {
    return TextFormField(
      controller: controller,
      keyboardType: inputType,
      maxLines: maxLines,
      style: const TextStyle(color: Colors.white, fontSize: 14),
      decoration: InputDecoration(
        labelText: label,
        labelStyle: TextStyle(color: Colors.white.withOpacity(0.5), fontSize: 13),
        prefixIcon: icon != null ? Icon(icon, color: Colors.white.withOpacity(0.4), size: 20) : null,
        filled: true,
        fillColor: Colors.white.withOpacity(0.08),
        contentPadding: const EdgeInsets.symmetric(horizontal: 14, vertical: 14),
        border: OutlineInputBorder(borderRadius: BorderRadius.circular(14), borderSide: BorderSide.none),
        enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(14), borderSide: BorderSide(color: Colors.white.withOpacity(0.08))),
        focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(14), borderSide: const BorderSide(color: _kGold)),
        errorStyle: const TextStyle(fontSize: 10),
        isDense: true,
      ),
      validator: isRequired ? (v) => (v == null || v.isEmpty) ? 'Required' : null : null,
    );
  }
}
