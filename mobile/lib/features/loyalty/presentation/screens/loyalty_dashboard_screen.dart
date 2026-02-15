import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/loyalty/data/repositories/loyalty_repository.dart';

class LoyaltyDashboardScreen extends ConsumerWidget {
  const LoyaltyDashboardScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final statsAsync = ref.watch(loyaltyStatsProvider);

    return Scaffold(
      backgroundColor: const Color(0xFF0F172A),
      appBar: AppBar(
        title: const Text('Loyalty & Tiers', style: TextStyle(color: Colors.white)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        iconTheme: const IconThemeData(color: Colors.white),
      ),
      body: statsAsync.when(
        data: (stats) => SingleChildScrollView(
          padding: const EdgeInsets.all(24),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              _buildTierCard(stats),
              const SizedBox(height: 32),
              const Text('Your Benefits', style: TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold)),
              const SizedBox(height: 16),
              _buildBenefitItem(Icons.local_shipping, 'Discounted Shipping', 'Up to 5% off economy shipping'),
              _buildBenefitItem(Icons.support_agent, 'Priority Support', 'Access to elite support agents'),
              _buildBenefitItem(Icons.verified, 'Verified Badge', 'Exclusive badge on your profile'),
              const SizedBox(height: 32),
              const Text('Tier Roadmap', style: TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold)),
              const SizedBox(height: 16),
              _buildRoadmap(),
            ],
          ),
        ),
        loading: () => const Center(child: CircularProgressIndicator(color: Colors.blue)),
        error: (err, stack) => Center(child: Text('Error: $err', style: const TextStyle(color: Colors.white))),
      ),
    );
  }

  Widget _buildTierCard(dynamic stats) {
    final tierColor = _getTierColor(stats.tier);
    return Container(
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          colors: [tierColor.withOpacity(0.8), tierColor.withOpacity(0.4)],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        borderRadius: BorderRadius.circular(24),
        border: Border.all(color: tierColor.withOpacity(0.5)),
        boxShadow: [BoxShadow(color: tierColor.withOpacity(0.2), blurRadius: 20, spreadRadius: 5)],
      ),
      child: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(stats.tier.toUpperCase(), style: TextStyle(color: Colors.white, fontSize: 28, fontWeight: FontWeight.w900, letterSpacing: 2)),
                  const Text('Current Status', style: TextStyle(color: Colors.white70, fontSize: 12)),
                ],
              ),
              Icon(Icons.stars, color: Colors.white, size: 48),
            ],
          ),
          const SizedBox(height: 32),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text('${stats.points} Points', style: const TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold)),
              if (stats.nextTier != null)
                Text('Next: ${stats.nextTier.toUpperCase()}', style: const TextStyle(color: Colors.white70, fontSize: 14)),
            ],
          ),
          const SizedBox(height: 12),
          ClipRRect(
            borderRadius: BorderRadius.circular(10),
            child: LinearProgressIndicator(
              value: stats.progressToNext,
              backgroundColor: Colors.white12,
              color: Colors.white,
              minHeight: 8,
            ),
          ),
          if (stats.pointsNeeded > 0)
            Padding(
              padding: const EdgeInsets.only(top: 12),
              child: Text('Ship more to earn ${stats.pointsNeeded} more points for ${stats.nextTier}!', 
                  style: const TextStyle(color: Colors.white70, fontSize: 13, fontStyle: FontStyle.italic)),
            ),
        ],
      ),
    );
  }

  Widget _buildBenefitItem(IconData icon, String title, String description) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(color: Colors.white.withOpacity(0.05), borderRadius: BorderRadius.circular(16)),
      child: Row(
        children: [
          Icon(icon, color: Colors.blue[400], size: 28),
          const SizedBox(width: 16),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(title, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                Text(description, style: const TextStyle(color: Colors.white54, fontSize: 12)),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildRoadmap() {
    return Column(
      children: [
        _buildTierStep('Bronze', '0 - 500 Pts', true),
        _buildTierStep('Silver', '501 - 2,000 Pts', false),
        _buildTierStep('Gold', '2,001 - 10,000 Pts', false),
        _buildTierStep('Diamond', '10,001+ Pts', false),
      ],
    );
  }

  Widget _buildTierStep(String name, String range, bool achieved) {
    return Row(
      children: [
        Column(
          children: [
            Container(
              width: 12, height: 12,
              decoration: BoxDecoration(color: achieved ? Colors.blue : Colors.grey, shape: BoxShape.circle),
            ),
            Container(width: 2, height: 40, color: Colors.grey.withOpacity(0.2)),
          ],
        ),
        const SizedBox(width: 16),
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(name, style: TextStyle(color: achieved ? Colors.white : Colors.white24, fontWeight: FontWeight.bold)),
              Text(range, style: TextStyle(color: achieved ? Colors.white54 : Colors.white10, fontSize: 12)),
            ],
          ),
        ),
      ],
    );
  }

  Color _getTierColor(String tier) {
    switch (tier.toLowerCase()) {
      case 'silver': return Colors.grey;
      case 'gold': return Colors.amber;
      case 'diamond': return Colors.cyan;
      default: return Colors.brown;
    }
  }
}
