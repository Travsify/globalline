import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/logistics/presentation/providers/logistics_provider.dart';
import 'package:mobile/features/logistics/data/models/logistics_models.dart';
import 'package:mobile/features/tracking/presentation/screens/global_network_map_screen.dart';

class TrackingScreen extends ConsumerStatefulWidget {
  const TrackingScreen({super.key});

  @override
  ConsumerState<TrackingScreen> createState() => _TrackingScreenState();
}

class _TrackingScreenState extends ConsumerState<TrackingScreen> with TickerProviderStateMixin {
  final _searchController = TextEditingController();
  String? _trackingNumber;
  late AnimationController _animationController;
  late TabController _tabController;

  @override
  void initState() {
    super.initState();
    _animationController = AnimationController(
        vsync: this, duration: const Duration(milliseconds: 1000));
    _tabController = TabController(length: 2, vsync: this);
  }

  @override
  void dispose() {
    _animationController.dispose();
    _tabController.dispose();
    _searchController.dispose();
    super.dispose();
  }

  void _handleSearch(String value) {
    if (value.isNotEmpty) {
      setState(() {
        _trackingNumber = value;
        _animationController.reset();
        _animationController.forward();
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF0F4F8),
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        title: const Text('Track Shipment', style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        centerTitle: true,
        iconTheme: const IconThemeData(color: Colors.white),
      ),
      body: Stack(
        children: [
          // Premium Background Header
          Positioned(
            top: 0,
            left: 0,
            right: 0,
            height: 300,
            child: Container(
              decoration: const BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                  colors: [
                    Color(0xFF002366),
                    Color(0xFF0D47A1),
                  ],
                ),
                borderRadius: BorderRadius.vertical(bottom: Radius.circular(32)),
              ),
              child: Stack(
                children: [
                  Positioned(
                    top: -50,
                    right: -50,
                    child: Container(
                      width: 200,
                      height: 200,
                      decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        color: Colors.white.withOpacity(0.05),
                      ),
                    ),
                  ),
                  Positioned(
                    bottom: 50,
                    left: -20,
                    child: Container(
                      width: 150,
                      height: 150,
                      decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        color: const Color(0xFFFFD700).withOpacity(0.1),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
          
          SafeArea(
            child: Column(
              children: [
                const SizedBox(height: 20),
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 24.0),
                  child: InkWell(
                    onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const GlobalNetworkMapScreen())),
                    child: Container(
                      padding: const EdgeInsets.all(16),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.1),
                        borderRadius: BorderRadius.circular(16),
                        border: Border.all(color: Colors.white.withOpacity(0.2)),
                      ),
                      child: Row(
                        children: [
                          const Icon(Icons.public, color: Colors.white, size: 24),
                          const SizedBox(width: 12),
                          const Expanded(
                            child: Text('View Live Global Network Map', style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                          ),
                          const Icon(Icons.chevron_right, color: Colors.white),
                        ],
                      ),
                    ),
                  ),
                ),
                const SizedBox(height: 12),
                // Tab Bar
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 24.0),
                  child: Container(
                    padding: const EdgeInsets.all(4),
                    decoration: BoxDecoration(
                      color: Colors.white.withOpacity(0.1),
                      borderRadius: BorderRadius.circular(16),
                    ),
                    child: TabBar(
                      controller: _tabController,
                      indicatorColor: Colors.transparent,
                      dividerColor: Colors.transparent,
                      labelColor: const Color(0xFF002366),
                      unselectedLabelColor: Colors.white,
                      indicator: BoxDecoration(
                        color: Colors.white,
                        borderRadius: BorderRadius.circular(12),
                      ),
                      indicatorSize: TabBarIndicatorSize.tab,
                      tabs: const [
                        Tab(text: 'Track'),
                        Tab(text: 'Warehouse'),
                      ],
                    ),
                  ),
                ),
                const SizedBox(height: 12),
                // Search Bar
                Expanded(
                  child: TabBarView(
                    controller: _tabController,
                    children: [
                      // Tab 1: Track Shipment
                      Column(
                        children: [
                          // Search Bar
                          Padding(
                            padding: const EdgeInsets.symmetric(horizontal: 24.0),
                            child: Container(
                              decoration: BoxDecoration(
                                color: Colors.white,
                                borderRadius: BorderRadius.circular(16),
                                boxShadow: [
                                  BoxShadow(
                                    color: Colors.black.withOpacity(0.1),
                                    blurRadius: 20,
                                    offset: const Offset(0, 10),
                                  ),
                                ],
                              ),
                              child: TextField(
                                controller: _searchController,
                                decoration: InputDecoration(
                                  hintText: 'Enter Tracking Number',
                                  hintStyle: TextStyle(color: Colors.grey[400]),
                                  border: InputBorder.none,
                                  contentPadding: const EdgeInsets.symmetric(horizontal: 20, vertical: 16),
                                  suffixIcon: IconButton(
                                    icon: const Icon(Icons.search, color: Color(0xFF002366)),
                                    onPressed: () => _handleSearch(_searchController.text),
                                  ),
                                ),
                                onSubmitted: _handleSearch,
                              ),
                            ),
                          ),
                          const SizedBox(height: 24),
                          Expanded(
                            child: _trackingNumber != null && _trackingNumber!.isNotEmpty
                                ? Consumer(
                                    builder: (context, ref, child) {
                                      final trackingAsync = ref.watch(shipmentTrackingProvider(_trackingNumber!));
                                      return trackingAsync.when(
                                        data: (shipment) => _TrackingDetails(
                                          shipment: shipment,
                                          animation: _animationController,
                                        ),
                                        loading: () => const Center(child: CircularProgressIndicator()),
                                        error: (err, stack) => Center(child: Text('Error: $err')),
                                      );
                                    },
                                  )
                                : const _EmptyState(),
                          ),
                        ],
                      ),
                      // Tab 2: My Warehouse
                      const _WarehousePackages(),
                    ],
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

class _EmptyState extends StatelessWidget {
  const _EmptyState();

  @override
  Widget build(BuildContext context) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Container(
            padding: const EdgeInsets.all(32),
            decoration: BoxDecoration(
              color: const Color(0xFF002366).withOpacity(0.05),
              shape: BoxShape.circle,
            ),
            child: Icon(Icons.local_shipping_outlined, size: 80, color: const Color(0xFF002366).withOpacity(0.3)),
          ),
          const SizedBox(height: 24),
          const Text(
            'Track your global shipments',
            style: TextStyle(
              fontSize: 18,
              fontWeight: FontWeight.bold,
              color: Color(0xFF002366),
            ),
          ),
          const SizedBox(height: 8),
          Text(
            'Enter a tracking number to get real-time status',
            style: TextStyle(color: Colors.grey[600]),
            textAlign: TextAlign.center,
          ),
        ],
      ),
    );
  }
}

class _TrackingDetails extends StatelessWidget {
  final Shipment shipment;
  final AnimationController animation;

  const _TrackingDetails({required this.shipment, required this.animation});

  @override
  Widget build(BuildContext context) {
    return FadeTransition(
      opacity: animation,
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 24),
        decoration: const BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.vertical(top: Radius.circular(32)),
        ),
        child: Column(
          children: [
            const SizedBox(height: 12),
            Center(
              child: Container(
                width: 40,
                height: 4,
                decoration: BoxDecoration(
                  color: Colors.grey[300],
                  borderRadius: BorderRadius.circular(2),
                ),
              ),
            ),
            const SizedBox(height: 32),
            Row(
              children: [
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Shipment ID',
                        style: TextStyle(color: Colors.grey[500], fontSize: 12),
                      ),
                      Text(
                        shipment.trackingNumber,
                        style: const TextStyle(
                          fontSize: 20,
                          fontWeight: FontWeight.bold,
                          color: Color(0xFF002366),
                        ),
                      ),
                    ],
                  ),
                ),
                 Container(
                  padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                  decoration: BoxDecoration(
                    color: const Color(0xFFFFD700).withOpacity(0.2),
                    borderRadius: BorderRadius.circular(20),
                  ),
                  child: Text(
                    shipment.status,
                    style: TextStyle(
                      color: Colors.orange.shade900,
                      fontWeight: FontWeight.bold,
                      fontSize: 12,
                    ),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 32),
            Expanded(
              child: ListView.builder(
                itemCount: shipment.history.length,
                itemBuilder: (context, index) {
                  final event = shipment.history[index];
                  final isFirst = index == 0;
                  final isLast = index == shipment.history.length - 1;
                  
                  return Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Column(
                        children: [
                          Container(
                            width: 20,
                            height: 20,
                            decoration: BoxDecoration(
                              shape: BoxShape.circle,
                              color: isFirst ? const Color(0xFF002366) : Colors.grey[300],
                              border: isFirst ? Border.all(color: const Color(0xFFFFD700), width: 3) : null,
                            ),
                          ),
                          if (!isLast)
                            Container(
                              width: 2,
                              height: 60,
                              color: Colors.grey[300],
                            ),
                        ],
                      ),
                      const SizedBox(width: 16),
                      Expanded(
                        child: Padding(
                          padding: const EdgeInsets.only(bottom: 32.0),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                event.description,
                                style: TextStyle(
                                  fontWeight: isFirst ? FontWeight.bold : FontWeight.normal,
                                  fontSize: 16,
                                  color: isFirst ? const Color(0xFF002366) : Colors.black87,
                                ),
                              ),
                              const SizedBox(height: 4),
                              Text(
                                '${event.location} • ${event.timestamp.toString().split(' ')[0]}',
                                style: TextStyle(
                                  color: Colors.grey[500],
                                  fontSize: 12,
                                ),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ],
                  );
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class _WarehousePackages extends ConsumerWidget {
  const _WarehousePackages();

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    return Padding(
      padding: const EdgeInsets.all(24.0),
      child: Column(
        children: [
          Container(
            padding: const EdgeInsets.all(20),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(20),
            ),
            child: const Row(
              children: [
                Icon(Icons.info_outline, color: Color(0xFF002366)),
                SizedBox(width: 12),
                Expanded(
                  child: Text(
                    'Packages received at your Global Suites will appear here for forwarding.',
                    style: TextStyle(fontSize: 12, color: Colors.grey),
                  ),
                ),
              ],
            ),
          ),
          const SizedBox(height: 24),
          Expanded(
            child: ListView(
              children: const [
                _WarehouseItem(
                  id: 'PKG-US-9982',
                  origin: 'Amazon US',
                  weight: '2.5 kg',
                  status: 'Received',
                  arrivalDate: '2026-02-18',
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

class _WarehouseItem extends StatelessWidget {
  final String id;
  final String origin;
  final String weight;
  final String status;
  final String arrivalDate;

  const _WarehouseItem({
    required this.id,
    required this.origin,
    required this.weight,
    required this.status,
    required this.arrivalDate,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(bottom: 16),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(24),
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
              Text(origin, style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16)),
              Text(status, style: const TextStyle(color: Colors.green, fontWeight: FontWeight.bold, fontSize: 12)),
            ],
          ),
          const SizedBox(height: 12),
          Row(
            children: [
              const Icon(Icons.inventory_2_outlined, size: 16, color: Colors.grey),
              const SizedBox(width: 8),
              Text(id, style: const TextStyle(color: Colors.grey, fontSize: 12)),
              const Spacer(),
              Text(weight, style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 14)),
            ],
          ),
          const Divider(height: 32),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text('Arrival Date', style: TextStyle(color: Colors.grey[500], fontSize: 10)),
                  Text(arrivalDate, style: const TextStyle(fontWeight: FontWeight.bold)),
                ],
              ),
              ElevatedButton(
                onPressed: () {},
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF002366),
                  foregroundColor: Colors.white,
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
                ),
                child: const Text('Forward'),
              ),
            ],
          ),
        ],
      ),
    );
  }
}
