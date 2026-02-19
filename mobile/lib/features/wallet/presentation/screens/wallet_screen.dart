import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/wallet/presentation/providers/wallet_provider.dart';
import 'package:mobile/features/wallet/data/models/wallet_models.dart';
import 'package:mobile/shared/widgets/status_widgets.dart';
import 'package:go_router/go_router.dart';

class WalletScreen extends ConsumerStatefulWidget {
  const WalletScreen({super.key});

  @override
  ConsumerState<WalletScreen> createState() => _WalletScreenState();
}

class _WalletScreenState extends ConsumerState<WalletScreen> {
  @override
  Widget build(BuildContext context) {
    final walletAsync = ref.watch(walletControllerProvider);

    return Scaffold(
      backgroundColor: const Color(0xFF001540), // Darker Navy
      body: walletAsync.when(
        data: (wallet) => RefreshIndicator(
          onRefresh: () async {
            await ref.read(walletControllerProvider.notifier).refresh();
          },
          child: CustomScrollView(
            slivers: [
              _buildSliverAppBar(context),
              SliverToBoxAdapter(child: _buildFxRibbon()),
              SliverToBoxAdapter(child: _buildHeroBalanceCarousel(wallet)),
              SliverToBoxAdapter(child: _buildActionMatrix(context)),
              SliverToBoxAdapter(child: _buildTransactionHeader()),
              _buildTransactionList(wallet),
            ],
          ),
        ),
        loading: () => const AppLoadingWidget(),
        error: (err, stack) => AppErrorWidget(
          message: err.toString(),
          onRetry: () => ref.read(walletControllerProvider.notifier).refresh(),
        ),
      ),
    );
  }

  Widget _buildSliverAppBar(BuildContext context) {
    return SliverAppBar(
      pinned: true,
      expandedHeight: 120,
      backgroundColor: Colors.transparent,
      elevation: 0,
      flexibleSpace: FlexibleSpaceBar(
        title: const Text(
          "Financial Command Center",
          style: TextStyle(
            color: Colors.white,
            fontWeight: FontWeight.bold,
            fontSize: 16,
            fontFamily: 'Outfit',
          ),
        ),
        centerTitle: false,
        titlePadding: const EdgeInsets.only(left: 20, bottom: 16),
      ),
      actions: [
        IconButton(
          icon: Container(
            padding: const EdgeInsets.all(8),
            decoration: BoxDecoration(
              color: Colors.white.withOpacity(0.05),
              shape: BoxShape.circle,
            ),
            child: const Icon(Icons.analytics_outlined, color: Colors.white, size: 20),
          ),
          onPressed: () {},
        ),
        const SizedBox(width: 12),
      ],
    );
  }

  Widget _buildFxRibbon() {
    return Container(
      height: 40,
      color: Colors.black.withOpacity(0.2),
      child: ListView(
        scrollDirection: Axis.horizontal,
        padding: const EdgeInsets.symmetric(horizontal: 20),
        children: [
          _FxItem(label: 'USD/CNY', rate: '7.21', change: '+0.04%'),
          _FxItem(label: 'USD/NGN', rate: '1550.00', change: '-1.2%'),
          _FxItem(label: 'USD/HKD', rate: '7.82', change: '0.0%'),
        ],
      ),
    );
  }

  Widget _buildHeroBalanceCarousel(Wallet wallet) {
    return Container(
      height: 220,
      margin: const EdgeInsets.symmetric(vertical: 20),
      child: PageView(
        controller: PageController(viewportFraction: 0.9),
        children: [
          _PremiumGlassCard(
            currency: 'Global USD',
            balance: '\$${wallet.balance.toStringAsFixed(2)}',
            cardColor: const Color(0xFF0D47A1).withOpacity(0.4),
            icon: Icons.public,
          ),
          const _PremiumGlassCard(
            currency: 'Factory CNY',
            balance: '¥8,450.00',
            cardColor: Color(0xFFB71C1C).withOpacity(0.4),
            icon: Icons.precision_manufacturing_outlined,
          ),
        ],
      ),
    );
  }

  Widget _buildActionMatrix(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20),
      child: GridView.count(
        shrinkWrap: true,
        physics: const NeverScrollableScrollPhysics(),
        crossAxisCount: 4,
        mainAxisSpacing: 20,
        crossAxisSpacing: 20,
        children: [
          _ActionPill(icon: Icons.add, label: 'Fund', color: const Color(0xFFFFD700), onTap: () => _showFundWalletDialog(context)),
          _ActionPill(icon: Icons.send_outlined, label: 'Send', color: Colors.blueAccent, onTap: () {}),
          _ActionPill(icon: Icons.swap_horiz, label: 'Convert', color: Colors.greenAccent, onTap: () => context.push('/wallet/convert')),
          _ActionPill(icon: Icons.account_balance_outlined, label: 'Finance', color: Colors.purpleAccent, onTap: () {}),
        ],
      ),
    );
  }

  Widget _buildTransactionHeader() {
    return const Padding(
      padding: EdgeInsets.fromLTRB(20, 32, 20, 16),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Text(
            'Recent Operations',
            style: TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold, fontFamily: 'Outfit'),
          ),
          Text(
            'See All',
            style: TextStyle(color: Color(0xFFFFD700), fontSize: 14, fontWeight: FontWeight.w500),
          ),
        ],
      ),
    );
  }

  Widget _buildTransactionList(Wallet wallet) {
    return SliverPadding(
      padding: const EdgeInsets.symmetric(horizontal: 20),
      sliver: SliverList(
        delegate: SliverChildBuilderDelegate(
          (context, index) {
            final tx = wallet.transactions[index];
            return _EnhancedTransactionTile(transaction: tx);
          },
          childCount: wallet.transactions.length,
        ),
      ),
    );
  }

  void _showFundWalletDialog(BuildContext context) {
    final amountController = TextEditingController();
    const fixedCurrency = 'NGN'; 

    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (ctx) => Container(
        padding: EdgeInsets.fromLTRB(24, 24, 24, MediaQuery.of(ctx).viewInsets.bottom + 24),
        decoration: const BoxDecoration(
          color: Color(0xFF001540),
          borderRadius: BorderRadius.vertical(top: Radius.circular(32)),
        ),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            const Text(
              "Initialize Funding",
              style: TextStyle(color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 8),
            const Text(
              "Local bank transfers are processed through our primary node. USD/CNY conversion is instant post-clearing.",
              style: TextStyle(color: Colors.white54, fontSize: 12),
            ),
            const SizedBox(height: 24),
            TextField(
              controller: amountController,
              keyboardType: const TextInputType.numberWithOptions(decimal: true),
              style: const TextStyle(color: Colors.white, fontSize: 24, fontWeight: FontWeight.bold),
              decoration: InputDecoration(
                labelText: "Local Amount (NGN)",
                labelStyle: const TextStyle(color: Color(0xFFFFD700)),
                prefixText: "₦ ",
                prefixStyle: const TextStyle(color: Color(0xFFFFD700), fontSize: 24),
                filled: true,
                fillColor: Colors.white.withOpacity(0.05),
                border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
              ),
            ),
            const SizedBox(height: 32),
            ElevatedButton(
              onPressed: () {
                final amount = double.tryParse(amountController.text);
                if (amount != null && amount > 0) {
                  Navigator.pop(ctx);
                  context.push('/checkout/payment', extra: {
                    'amount': amount,
                    'currency': fixedCurrency,
                    'email': 'user@globalline.com', 
                    'isFunding': true,
                  });
                }
              },
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFFFFD700),
                foregroundColor: const Color(0xFF001540),
                padding: const EdgeInsets.symmetric(vertical: 18),
                shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
              ),
              child: const Text("EXECUTE TRANSACTION", style: TextStyle(fontWeight: FontWeight.bold, letterSpacing: 1.1)),
            ),
          ],
        ),
      ),
    );
  }
}

class _FxItem extends StatelessWidget {
  final String label;
  final String rate;
  final String change;
  const _FxItem({required this.label, required this.rate, required this.change});

  @override
  Widget build(BuildContext context) {
    final isNegative = change.startsWith('-');
    return Padding(
      padding: const EdgeInsets.only(right: 24),
      child: Row(
        children: [
          Text(label, style: const TextStyle(color: Colors.white60, fontSize: 10, fontWeight: FontWeight.bold)),
          const SizedBox(width: 4),
          Text(rate, style: const TextStyle(color: Colors.white, fontSize: 10, fontWeight: FontWeight.w500)),
          const SizedBox(width: 4),
          Text(change, style: TextStyle(color: isNegative ? Colors.redAccent : Colors.greenAccent, fontSize: 9)),
        ],
      ),
    );
  }
}

class _PremiumGlassCard extends StatelessWidget {
  final String currency;
  final String balance;
  final Color cardColor;
  final IconData icon;

  const _PremiumGlassCard({
    required this.currency,
    required this.balance,
    required this.cardColor,
    required this.icon,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 10),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius: BorderRadius.circular(32),
        border: Border.all(color: Colors.white.withOpacity(0.1)),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.3),
            blurRadius: 20,
            offset: const Offset(0, 10),
          ),
        ],
      ),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(32),
        child: BackdropFilter(
          filter: ImageFilter.blur(sigmaX: 10, sigmaY: 10),
          child: Padding(
            padding: const EdgeInsets.all(32),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(currency.toUpperCase(), style: const TextStyle(color: Colors.white70, fontSize: 12, fontWeight: FontWeight.bold, letterSpacing: 1.2)),
                    Icon(icon, color: Colors.white30, size: 24),
                  ],
                ),
                Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    FittedBox(
                      child: Text(
                        balance,
                        style: const TextStyle(color: Colors.white, fontSize: 36, fontWeight: FontWeight.bold, fontFamily: 'Outfit'),
                      ),
                    ),
                    const SizedBox(height: 8),
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
                      decoration: BoxDecoration(color: Colors.white.withOpacity(0.1), borderRadius: BorderRadius.circular(20)),
                      child: const Text('TRUSTED NODE', style: TextStyle(color: Color(0xFFFFD700), fontSize: 9, fontWeight: FontWeight.bold)),
                    ),
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

class _ActionPill extends StatelessWidget {
  final IconData icon;
  final String label;
  final Color color;
  final VoidCallback onTap;

  const _ActionPill({required this.icon, required this.label, required this.color, required this.onTap});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Column(
        children: [
          Container(
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              color: color.withOpacity(0.1),
              borderRadius: BorderRadius.circular(18),
              border: Border.all(color: color.withOpacity(0.2)),
            ),
            child: Icon(icon, color: color, size: 24),
          ),
          const SizedBox(height: 8),
          Text(label, style: const TextStyle(color: Colors.white70, fontSize: 11, fontWeight: FontWeight.w500)),
        ],
      ),
    );
  }
}

class _EnhancedTransactionTile extends StatelessWidget {
  final WalletTransaction transaction;
  const _EnhancedTransactionTile({required this.transaction});

  @override
  Widget build(BuildContext context) {
    final isCredit = transaction.type == 'Credit';
    
    // Logic for tags based on description
    String tag = 'TRADE';
    if (transaction.description.toLowerCase().contains('source')) tag = 'SOURCING';
    if (transaction.description.toLowerCase().contains('ship')) tag = 'LOGISTICS';
    if (transaction.description.toLowerCase().contains('convert')) tag = 'EXCHANGE';

    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(24),
        border: Border.all(color: Colors.white.withOpacity(0.05)),
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(10),
            decoration: BoxDecoration(
              color: isCredit ? Colors.greenAccent.withOpacity(0.1) : Colors.redAccent.withOpacity(0.1),
              shape: BoxShape.circle,
            ),
            child: Icon(
              isCredit ? Icons.arrow_downward : Icons.arrow_upward,
              color: isCredit ? Colors.greenAccent : Colors.redAccent,
              size: 20,
            ),
          ),
          const SizedBox(width: 16),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  transaction.description,
                  style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 14),
                  maxLines: 1,
                  overflow: TextOverflow.ellipsis,
                ),
                const SizedBox(height: 4),
                Row(
                  children: [
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 6, vertical: 2),
                      decoration: BoxDecoration(color: Colors.white10, borderRadius: BorderRadius.circular(4)),
                      child: Text(tag, style: const TextStyle(color: Colors.white54, fontSize: 8, fontWeight: FontWeight.bold)),
                    ),
                    const SizedBox(width: 8),
                    Text(
                      transaction.date.toString().split(' ')[0],
                      style: const TextStyle(color: Colors.white24, fontSize: 10),
                    ),
                  ],
                ),
              ],
            ),
          ),
          Text(
            '${isCredit ? '+' : '-'} \$${transaction.amount.toStringAsFixed(2)}',
            style: TextStyle(
              color: isCredit ? Colors.greenAccent : Colors.white,
              fontWeight: FontWeight.bold,
              fontSize: 16,
              fontFamily: 'Outfit',
            ),
          ),
        ],
      ),
    );
  }
}
