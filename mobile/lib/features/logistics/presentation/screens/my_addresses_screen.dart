import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';
import 'package:mobile/features/auth/presentation/providers/auth_provider.dart';

final virtualAddressesProvider = FutureProvider((ref) async {
  final dio = ref.read(dioProvider);
  final response = await dio.get('logistics/virtual-addresses/my');
  return response.data as List;
});

final availableRegionsProvider = FutureProvider((ref) async {
  final dio = ref.read(dioProvider);
  final response = await dio.get('logistics/virtual-addresses/regions');
  return response.data as List;
});

class MyAddressesScreen extends ConsumerStatefulWidget {
  const MyAddressesScreen({super.key});

  @override
  ConsumerState<MyAddressesScreen> createState() => _MyAddressesScreenState();
}

class _MyAddressesScreenState extends ConsumerState<MyAddressesScreen> {
  bool _isRequesting = false;

  Future<void> _requestAddress(String regionId) async {
    setState(() => _isRequesting = true);
    try {
      final dio = ref.read(dioProvider);
      await dio.post('logistics/virtual-addresses/request', data: {'region': regionId});
      
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            backgroundColor: const Color(0xFFFFD700),
            content: Text('Global Suite initialized in ${regionId.toUpperCase()}!', 
              style: const TextStyle(color: Color(0xFF001540), fontWeight: FontWeight.bold)),
          ),
        );
        ref.invalidate(virtualAddressesProvider);
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Activation Failed: $e')),
        );
      }
    } finally {
      if (mounted) setState(() => _isRequesting = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    final myAddresses = ref.watch(virtualAddressesProvider);
    final regions = ref.watch(availableRegionsProvider);

    return Scaffold(
      backgroundColor: const Color(0xFF001540),
      appBar: AppBar(
        title: const Text('My Global Suites', 
          style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        actions: [
          IconButton(
            icon: const Icon(Icons.info_outline, color: Colors.white70),
            onPressed: () => _showHowItWorks(context),
          ),
        ],
      ),
      body: CustomScrollView(
        slivers: [
          _buildHeader(),
          
          // My Active Addresses
          myAddresses.when(
            data: (addresses) => addresses.isEmpty 
              ? _buildEmptyState()
              : SliverList(
                  delegate: SliverChildBuilderDelegate(
                    (context, index) {
                      final addr = addresses[index];
                      return _SuiteCard(
                        region: addr['region'],
                        suite: addr['suite_number'],
                        status: addr['status'],
                        address: addr['full_address'] ?? "GlobalLine Warehouse Node, ${addr['region'].toString().toUpperCase()}",
                      );
                    },
                    childCount: addresses.length,
                  ),
                ),
            loading: () => const SliverToBoxAdapter(child: Center(child: Padding(
              padding: EdgeInsets.all(40.0),
              child: CircularProgressIndicator(color: Color(0xFFFFD700)),
            ))),
            error: (e, s) => SliverToBoxAdapter(child: Center(child: Text('Error: $e', style: const TextStyle(color: Colors.white)))),
          ),

          const SliverToBoxAdapter(child: SizedBox(height: 48)),
          
          _buildRegionHeader(),

          regions.when(
            data: (regionList) => SliverPadding(
              padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 16),
              sliver: SliverGrid(
                gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                  crossAxisCount: 2,
                  crossAxisSpacing: 16,
                  mainAxisSpacing: 16,
                  childAspectRatio: 1.3,
                ),
                delegate: SliverChildBuilderDelegate(
                  (context, index) {
                    final region = regionList[index];
                    return _RegionActivationCard(
                      name: region['name'],
                      fee: region['activation_fee'],
                      isRequesting: _isRequesting,
                      onTap: () => _requestAddress(region['id']),
                    );
                  },
                  childCount: regionList.length,
                ),
              ),
            ),
            loading: () => const SliverToBoxAdapter(child: SizedBox.shrink()),
            error: (e, s) => const SliverToBoxAdapter(child: SizedBox.shrink()),
          ),
          const SliverToBoxAdapter(child: SizedBox(height: 100)),
        ],
      ),
    );
  }

  Widget _buildHeader() {
    return SliverToBoxAdapter(
      child: Container(
        padding: const EdgeInsets.all(24.0),
        decoration: BoxDecoration(
          color: Colors.white.withOpacity(0.05),
          border: Border(bottom: BorderSide(color: Colors.white.withOpacity(0.1))),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Virtual Shipping Hubs',
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: Colors.white, fontFamily: 'Outfit'),
            ),
            const SizedBox(height: 12),
            Text(
              'Your dedicated addresses for global procurement. Sip items from 1688, Amazon, or Noon to these suites.',
              style: TextStyle(color: Colors.white.withOpacity(0.6), height: 1.5, fontSize: 13),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildEmptyState() {
    return SliverToBoxAdapter(
      child: Padding(
        padding: const EdgeInsets.all(48.0),
        child: Column(
          children: [
            Icon(Icons.location_off_outlined, size: 64, color: Colors.white.withOpacity(0.1)),
            const SizedBox(height: 16),
            const Text(
              "No Active Suites",
              style: TextStyle(color: Colors.white30, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 8),
            const Text(
              "Activate a region below to start shipping.",
              style: TextStyle(color: Colors.white24, fontSize: 12),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildRegionHeader() {
    return SliverToBoxAdapter(
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 24.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Expand Your Presence',
              style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold, color: Color(0xFFFFD700), fontFamily: 'Outfit'),
            ),
            const SizedBox(height: 4),
            Text(
              'Activate new warehouses instantly.',
              style: TextStyle(color: Colors.white.withOpacity(0.4), fontSize: 12),
            ),
          ],
        ),
      ),
    );
  }

  void _showHowItWorks(BuildContext context) {
    showModalBottomSheet(
      context: context,
      backgroundColor: const Color(0xFF001540),
      shape: const RoundedRectangleBorder(borderRadius: BorderRadius.vertical(top: Radius.circular(32))),
      builder: (context) => Padding(
        padding: const EdgeInsets.all(32.0),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text("How Global Suites Work", style: TextStyle(color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold)),
            const SizedBox(height: 24),
            _buildStep("1", "Choose a region and activate your suite."),
            _buildStep("2", "Shop on international stores using your new address."),
            _buildStep("3", "We receive and inspect your items."),
            _buildStep("4", "Ship multiple items together to save 70%."),
            const SizedBox(height: 32),
            SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                onPressed: () => Navigator.pop(context),
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFFFFD700),
                  foregroundColor: const Color(0xFF001540),
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                  padding: const EdgeInsets.symmetric(vertical: 16),
                ),
                child: const Text("GOT IT", style: TextStyle(fontWeight: FontWeight.bold)),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildStep(String num, String text) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 16.0),
      child: Row(
        children: [
          CircleAvatar(radius: 12, backgroundColor: const Color(0xFFFFD700), child: Text(num, style: const TextStyle(fontSize: 10, color: Color(0xFF001540), fontWeight: FontWeight.bold))),
          const SizedBox(width: 16),
          Expanded(child: Text(text, style: const TextStyle(color: Colors.white70, fontSize: 14))),
        ],
      ),
    );
  }
}

class _SuiteCard extends StatelessWidget {
  final String region;
  final String suite;
  final String status;
  final String address;

  const _SuiteCard({
    required this.region,
    required this.suite,
    required this.status,
    required this.address,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(24),
        border: Border.all(color: Colors.white.withOpacity(0.1)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            padding: const EdgeInsets.all(20),
            decoration: BoxDecoration(
              color: Colors.white.withOpacity(0.02),
              borderRadius: const BorderRadius.vertical(top: Radius.circular(24)),
            ),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Row(
                  children: [
                    _buildFlag(region),
                    const SizedBox(width: 12),
                    Text(region.toUpperCase(), 
                      style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 18, color: Colors.white, fontFamily: 'Outfit')),
                  ],
                ),
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                  decoration: BoxDecoration(
                    color: Colors.greenAccent.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Text(
                    status.toUpperCase(),
                    style: const TextStyle(color: Colors.greenAccent, fontSize: 9, fontWeight: FontWeight.bold),
                  ),
                ),
              ],
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(20),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('SUITE NUMBER', style: TextStyle(color: Colors.white.withOpacity(0.4), fontSize: 10, fontWeight: FontWeight.bold, letterSpacing: 1)),
                        const SizedBox(height: 4),
                        Text(suite, style: const TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: Color(0xFFFFD700), fontFamily: 'Outfit')),
                      ],
                    ),
                    IconButton(
                      icon: const Icon(Icons.copy_all, color: Colors.white38),
                      onPressed: () {
                        Clipboard.setData(ClipboardData(text: suite));
                        ScaffoldMessenger.of(context).showSnackBar(const SnackBar(content: Text('Suite ID copied!')));
                      },
                    ),
                  ],
                ),
                const SizedBox(height: 20),
                Text('WAREHOUSE ADDRESS', style: TextStyle(color: Colors.white.withOpacity(0.4), fontSize: 10, fontWeight: FontWeight.bold, letterSpacing: 1)),
                const SizedBox(height: 8),
                Text(address, style: const TextStyle(color: Colors.white70, fontSize: 13, height: 1.4)),
                const SizedBox(height: 24),
                Row(
                  children: [
                    Expanded(
                      child: _ActionLink(
                        label: "COPY FULL",
                        icon: Icons.content_copy,
                        onTap: () {
                          Clipboard.setData(ClipboardData(text: "$address\nSuite: $suite"));
                          ScaffoldMessenger.of(context).showSnackBar(const SnackBar(content: Text('Full address block copied!')));
                        },
                      ),
                    ),
                    const SizedBox(width: 12),
                    Expanded(
                      child: _ActionLink(
                        label: "VIEW LOGS",
                        icon: Icons.history,
                        onTap: () {},
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildFlag(String region) {
    String emoji = '🌐';
    if (region.toLowerCase().contains('china')) emoji = '🇨🇳';
    if (region.toLowerCase().contains('turkey')) emoji = '🇹🇷';
    if (region.toLowerCase().contains('uae')) emoji = '🇦🇪';
    if (region.toLowerCase().contains('usa')) emoji = '🇺🇸';
    if (region.toLowerCase().contains('uk')) emoji = '🇬🇧';
    
    return Text(emoji, style: const TextStyle(fontSize: 24));
  }
}

class _ActionLink extends StatelessWidget {
  final String label;
  final IconData icon;
  final VoidCallback onTap;

  const _ActionLink({required this.label, required this.icon, required this.onTap});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 12),
        decoration: BoxDecoration(
          color: Colors.white.withOpacity(0.05),
          borderRadius: BorderRadius.circular(12),
          border: Border.all(color: Colors.white.withOpacity(0.05)),
        ),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(icon, color: Colors.white54, size: 14),
            const SizedBox(width: 8),
            Text(label, style: const TextStyle(color: Colors.white54, fontSize: 11, fontWeight: FontWeight.bold)),
          ],
        ),
      ),
    );
  }
}

class _RegionActivationCard extends StatelessWidget {
  final String name;
  final dynamic fee;
  final bool isRequesting;
  final VoidCallback onTap;

  const _RegionActivationCard({
    required this.name,
    required this.fee,
    required this.isRequesting,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: isRequesting ? null : onTap,
      child: Container(
        decoration: BoxDecoration(
          color: Colors.white.withOpacity(0.05),
          borderRadius: BorderRadius.circular(20),
          border: Border.all(color: const Color(0xFFFFD700).withOpacity(0.2)),
        ),
        padding: const EdgeInsets.all(16),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(name, 
              textAlign: TextAlign.center,
              style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 13)),
            const SizedBox(height: 8),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
              decoration: BoxDecoration(color: const Color(0xFFFFD700).withOpacity(0.1), borderRadius: BorderRadius.circular(8)),
              child: Text(
                fee == 0 ? 'FREE' : '\$$fee',
                style: const TextStyle(color: Color(0xFFFFD700), fontSize: 10, fontWeight: FontWeight.bold),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
