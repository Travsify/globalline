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
          SnackBar(content: Text('Address requested in ${regionId.toUpperCase()}!')),
        );
        ref.invalidate(virtualAddressesProvider);
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Failed to request address: $e')),
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
      appBar: AppBar(
        title: const Text('My Global Suites'),
        centerTitle: true,
      ),
      body: CustomScrollView(
        slivers: [
          const SliverToBoxAdapter(
            child: Padding(
              padding: EdgeInsets.all(24.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Your Shipping Hubs',
                    style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
                  ),
                  SizedBox(height: 8),
                  Text(
                    'Use these addresses to shop from international stores. Packages sent here will appear in your warehouse.',
                    style: TextStyle(color: Colors.grey),
                  ),
                ],
              ),
            ),
          ),
          
          // My Active Addresses
          myAddresses.when(
            data: (addresses) => addresses.isEmpty 
              ? const SliverToBoxAdapter(child: SizedBox.shrink())
              : SliverList(
                  delegate: SliverChildBuilderDelegate(
                    (context, index) {
                      final addr = addresses[index];
                      return _AddressItem(
                        region: addr['region'],
                        suite: addr['suite_number'],
                        status: addr['status'],
                      );
                    },
                    childCount: addresses.length,
                  ),
                ),
            loading: () => const SliverToBoxAdapter(child: Center(child: CircularProgressIndicator())),
            error: (e, s) => SliverToBoxAdapter(child: Text('Error: $e')),
          ),

          const SliverToBoxAdapter(child: SizedBox(height: 32)),
          
          const SliverToBoxAdapter(
            child: Padding(
              padding: EdgeInsets.symmetric(horizontal: 24.0),
              child: Text(
                'Available Regions',
                style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
              ),
            ),
          ),

          regions.when(
            data: (regionList) => SliverPadding(
              padding: const EdgeInsets.all(24),
              sliver: SliverGrid(
                gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                  crossAxisCount: 2,
                  crossAxisSpacing: 16,
                  mainAxisSpacing: 16,
                  childAspectRatio: 1.5,
                ),
                delegate: SliverChildBuilderDelegate(
                  (context, index) {
                    final region = regionList[index];
                    return _RegionCard(
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
        ],
      ),
    );
  }
}

class _AddressItem extends StatelessWidget {
  final String region;
  final String suite;
  final String status;

  const _AddressItem({
    required this.region,
    required this.suite,
    required this.status,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 24, vertical: 8),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(20),
        boxShadow: [
          BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10, offset: const Offset(0, 4)),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(region.toUpperCase(), style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 18)),
              Container(
                padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                decoration: BoxDecoration(
                  color: Colors.green.withOpacity(0.1),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: Text(
                  status.toUpperCase(),
                  style: const TextStyle(color: Colors.green, fontSize: 10, fontWeight: FontWeight.bold),
                ),
              ),
            ],
          ),
          const SizedBox(height: 12),
          Text(
            'Suite Number:',
            style: TextStyle(color: Colors.grey[600], fontSize: 12),
          ),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(suite, style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold, color: Color(0xFF002366))),
              IconButton(
                icon: const Icon(Icons.copy, size: 20),
                onPressed: () {
                  Clipboard.setData(ClipboardData(text: suite));
                  ScaffoldMessenger.of(context).showSnackBar(const SnackBar(content: Text('Suite number copied!')));
                },
              ),
            ],
          ),
        ],
      ),
    );
  }
}

class _RegionCard extends StatelessWidget {
  final String name;
  final dynamic fee;
  final bool isRequesting;
  final VoidCallback onTap;

  const _RegionCard({
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
          color: const Color(0xFF002366),
          borderRadius: BorderRadius.circular(20),
        ),
        padding: const EdgeInsets.all(16),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(name, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
            const SizedBox(height: 4),
            Text(
              fee == 0 ? 'FREE activation' : '\$$fee activation',
              style: TextStyle(color: Colors.white.withOpacity(0.7), fontSize: 10),
            ),
          ],
        ),
      ),
    );
  }
}
