import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/marketplace/presentation/providers/marketplace_provider.dart';
import 'package:mobile/features/marketplace/presentation/providers/currency_provider.dart';
import 'package:mobile/features/marketplace/presentation/screens/ai_sourcing_screen.dart';

class SourcingHubScreen extends ConsumerStatefulWidget {
  const SourcingHubScreen({super.key});

  @override
  ConsumerState<SourcingHubScreen> createState() => _SourcingHubScreenState();
}

class _SourcingHubScreenState extends ConsumerState<SourcingHubScreen> {
  final _searchController = TextEditingController();
  String _selectedCategory = '🔥 Trending';

  final List<String> _categories = [
    '🔥 Trending',
    '📱 Electronics',
    '👗 Fashion',
    '🏭 Industrial',
    '💊 Medical',
    '🚗 Auto Parts',
    '💄 Cosmetics',
  ];

  @override
  Widget build(BuildContext context) {
    final productsAsync = ref.watch(productSearchProvider(_selectedCategory.toLowerCase().replaceAll(' ', '')));
    final currency = ref.watch(selectedCurrencyProvider);

    return Scaffold(
      backgroundColor: const Color(0xFF001540), // GlobalLine Deep Navy
      body: Stack(
        children: [
          // 1. Sentient Background Bloom
          Positioned(
            top: -100,
            right: -100,
            child: Container(
              width: 400,
              height: 400,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: const Color(0xFFFFD700).withOpacity(0.03),
              ),
            ),
          ),

          // 2. Main Content
          CustomScrollView(
            slivers: [
              _buildAppBar(context),
              SliverToBoxAdapter(
                child: _buildCategoryList(),
              ),
              _buildProductGrid(productsAsync, currency),
              const SliverToBoxAdapter(child: SizedBox(height: 120)),
            ],
          ),

          // 3. Floating Action Matrix
          Positioned(
            bottom: 0,
            left: 0,
            right: 0,
            child: _buildBottomActionStrip(context),
          ),
        ],
      ),
    );
  }

  Widget _buildAppBar(BuildContext context) {
    return SliverAppBar(
      pinned: true,
      expandedHeight: 220,
      backgroundColor: Colors.transparent,
      elevation: 0,
      flexibleSpace: FlexibleSpaceBar(
        background: ClipRRect(
          child: BackdropFilter(
            filter: ImageFilter.blur(sigmaX: 10, sigmaY: 10),
            child: Container(
              decoration: BoxDecoration(
                color: Colors.black.withOpacity(0.3),
                border: Border(bottom: BorderSide(color: Colors.white.withOpacity(0.05))),
              ),
              padding: const EdgeInsets.all(24),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.end,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const Text('NEURAL SOURCING', 
                    style: TextStyle(color: Color(0xFFFFD700), fontSize: 10, letterSpacing: 4, fontWeight: FontWeight.bold)),
                  const SizedBox(height: 8),
                  const Text('Global Supply Hub', 
                    style: TextStyle(color: Colors.white, fontSize: 32, fontWeight: FontWeight.bold, fontFamily: 'Outfit')),
                  const SizedBox(height: 24),
                  Container(
                    decoration: BoxDecoration(
                      color: Colors.white.withOpacity(0.05),
                      borderRadius: BorderRadius.circular(16),
                      border: Border.all(color: Colors.white.withOpacity(0.1)),
                    ),
                    child: TextField(
                      controller: _searchController,
                      style: const TextStyle(color: Colors.white),
                      decoration: InputDecoration(
                        hintText: 'Transmit sourcing intent...',
                        hintStyle: TextStyle(color: Colors.white.withOpacity(0.2)),
                        prefixIcon: const Icon(Icons.search, color: Color(0xFFFFD700)),
                        border: InputBorder.none,
                        contentPadding: const EdgeInsets.symmetric(horizontal: 20, vertical: 16),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildCategoryList() {
    return Container(
      height: 60,
      padding: const EdgeInsets.symmetric(vertical: 12),
      child: ListView.builder(
        scrollDirection: Axis.horizontal,
        padding: const EdgeInsets.symmetric(horizontal: 20),
        itemCount: _categories.length,
        itemBuilder: (context, index) {
          final cat = _categories[index];
          final isSelected = _selectedCategory == cat;
          return Padding(
            padding: const EdgeInsets.only(right: 12),
            child: GestureDetector(
              onTap: () => setState(() => _selectedCategory = cat),
              child: Container(
                padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                decoration: BoxDecoration(
                  color: isSelected ? const Color(0xFFFFD700) : Colors.white.withOpacity(0.03),
                  borderRadius: BorderRadius.circular(12),
                  border: Border.all(color: isSelected ? const Color(0xFFFFD700) : Colors.white10),
                ),
                child: Center(
                  child: Text(
                    cat.toUpperCase(),
                    style: TextStyle(
                      color: isSelected ? const Color(0xFF001540) : Colors.white30,
                      fontWeight: FontWeight.bold,
                      fontSize: 10,
                      letterSpacing: 1,
                    ),
                  ),
                ),
              ),
            ),
          );
        },
      ),
    );
  }

  Widget _buildProductGrid(AsyncValue productsAsync, String currency) {
    return productsAsync.when(
      data: (products) => SliverPadding(
        padding: const EdgeInsets.all(20),
        sliver: SliverGrid(
          gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
            crossAxisCount: 2,
            childAspectRatio: 0.7,
            crossAxisSpacing: 16,
            mainAxisSpacing: 16,
          ),
          delegate: SliverChildBuilderDelegate(
            (context, index) {
              final product = (products as List)[index];
              return _SourcingCard(product: product);
            },
            childCount: (products as List).length,
          ),
        ),
      ),
      loading: () => const SliverFillRemaining(child: Center(child: CircularProgressIndicator(color: Color(0xFFFFD700)))),
      error: (e, s) => SliverFillRemaining(child: Center(child: Text('Node Offline: $e', style: const TextStyle(color: Colors.white24)))),
    );
  }

  Widget _buildBottomActionStrip(BuildContext context) {
    return ClipRRect(
      child: BackdropFilter(
        filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
        child: Container(
          padding: EdgeInsets.fromLTRB(20, 16, 20, MediaQuery.of(context).padding.bottom + 16),
          decoration: BoxDecoration(
            color: Colors.black.withOpacity(0.4),
            border: Border(top: BorderSide(color: Colors.white.withOpacity(0.05))),
          ),
          child: Row(
            children: [
              Expanded(
                child: _ActionPill(
                  label: 'NEURAL AGENT',
                  icon: Icons.auto_awesome,
                  color: Colors.white.withOpacity(0.05),
                  borderColor: Colors.white.withOpacity(0.1),
                  onTap: () => _openAiAssistant(context),
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: _ActionPill(
                  label: 'TRANSFORM TO RFQ',
                  icon: Icons.flash_on,
                  color: const Color(0xFFFFD700),
                  textColor: const Color(0xFF001540),
                  onTap: () => context.push('/marketplace/sourcing/create'),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  void _openAiAssistant(BuildContext context) {
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (context) => DraggableScrollableSheet(
        initialChildSize: 0.95,
        maxChildSize: 0.95,
        minChildSize: 0.5,
        builder: (_, controller) => Container(
          decoration: const BoxDecoration(
            color: Color(0xFF001540),
            borderRadius: BorderRadius.vertical(top: Radius.circular(32)),
          ),
          child: const AiSourcingScreen(),
        ),
      ),
    );
  }
}

class _SourcingCard extends StatelessWidget {
  final dynamic product;
  const _SourcingCard({required this.product});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () => context.push('/product/${product.id}'),
      child: Container(
        decoration: BoxDecoration(
          color: Colors.white.withOpacity(0.02),
          borderRadius: BorderRadius.circular(20),
          border: Border.all(color: Colors.white.withOpacity(0.05)),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Expanded(
              flex: 3,
              child: Stack(
                fit: StackFit.expand,
                children: [
                  ClipRRect(
                    borderRadius: const BorderRadius.vertical(top: Radius.circular(20)),
                    child: Image.network(product.imageUrl, fit: BoxFit.cover),
                  ),
                  Positioned(
                    top: 8,
                    left: 8,
                    child: Container(
                      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                      decoration: BoxDecoration(color: Colors.black.withOpacity(0.6), borderRadius: BorderRadius.circular(8)),
                      child: Text('VERIFIED', style: TextStyle(color: const Color(0xFFFFD700).withOpacity(0.8), fontSize: 8, fontWeight: FontWeight.bold, letterSpacing: 1)),
                    ),
                  ),
                ],
              ),
            ),
            Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(product.title, maxLines: 1, overflow: TextOverflow.ellipsis, 
                    style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 13, fontFamily: 'Outfit')),
                  const SizedBox(height: 4),
                  Text('MOQ: ${product.moq}', style: const TextStyle(color: Colors.white30, fontSize: 10)),
                  const SizedBox(height: 8),
                  Text(
                    '${product.symbol}${product.displayPrice.toStringAsFixed(2)}',
                    style: const TextStyle(color: Color(0xFFFFD700), fontWeight: FontWeight.w900, fontSize: 16),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class _ActionPill extends StatelessWidget {
  final String label;
  final IconData icon;
  final Color color;
  final Color? borderColor;
  final Color textColor;
  final VoidCallback onTap;

  const _ActionPill({
    required this.label,
    required this.icon,
    required this.color,
    this.borderColor,
    this.textColor = Colors.white,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        height: 56,
        decoration: BoxDecoration(
          color: color,
          borderRadius: BorderRadius.circular(16),
          border: borderColor != null ? Border.all(color: borderColor!) : null,
        ),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(icon, color: textColor, size: 20),
            const SizedBox(width: 12),
            Text(label, style: TextStyle(color: textColor, fontWeight: FontWeight.bold, fontSize: 11, letterSpacing: 1.2)),
          ],
        ),
      ),
    );
  }
}
