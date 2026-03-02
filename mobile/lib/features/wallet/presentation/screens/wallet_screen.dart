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
    final multiBalancesAsync = ref.watch(multiCurrencyBalancesProvider);

    return Container(
      height: 220,
      margin: const EdgeInsets.symmetric(vertical: 20),
      child: multiBalancesAsync.when(
        data: (balances) {
          // Fallback if no specific balances found
          if (balances.isEmpty) {
            return PageView(
              controller: PageController(viewportFraction: 0.9),
              children: [
                _PremiumGlassCard(
                  currency: 'Global USD',
                  balance: '\$${wallet.balance.toStringAsFixed(2)}',
                  cardColor: const Color(0xFF0D47A1).withOpacity(0.4),
                  icon: Icons.public,
                ),
              ],
            );
          }

          return PageView.builder(
            controller: PageController(viewportFraction: 0.9),
            itemCount: balances.length,
            itemBuilder: (context, index) {
              final bal = balances[index];
              final currency = bal.currency;
              final amount = bal.amount.toDouble();
              final symbol = bal.symbol;
              
              Color cardColor = const Color(0xFF0D47A1).withOpacity(0.4);
              IconData icon = Icons.public;
              
              if (currency == 'CNY') {
                cardColor = const Color(0xFFB71C1C).withOpacity(0.4);
                icon = Icons.precision_manufacturing_outlined;
              } else if (currency == 'NGN') {
                cardColor = const Color(0xFF1B5E20).withOpacity(0.4);
                icon = Icons.account_balance_outlined;
              }

              return _PremiumGlassCard(
                currency: currency == 'USD' ? 'Global USD' : (currency == 'CNY' ? 'China RMB (CNY)' : 'Nigeria (NGN)'),
                balance: '$symbol${amount.toStringAsFixed(2)}',
                cardColor: cardColor,
                icon: icon,
              );
            },
          );
        },
        loading: () => const Center(child: CircularProgressIndicator()),
        error: (err, st) => Center(child: Text('Error loading balances: $err')),
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
          _ActionPill(icon: Icons.add, label: 'Deposit', color: const Color(0xFFFFD700), onTap: () => _showFundWalletDialog(context)),
          _ActionPill(icon: Icons.send_outlined, label: 'Transfer', color: Colors.blueAccent, onTap: () => _showTransferDialog(context)),
          _ActionPill(icon: Icons.swap_horiz, label: 'Exchange', color: Colors.greenAccent, onTap: () => context.push('/wallet/convert')),
          _ActionPill(icon: Icons.qr_code_scanner, label: 'Scan', color: Colors.purpleAccent, onTap: () async {
            final result = await context.push<String>('/wallet/scan');
            if (result != null && mounted) {
              _showTransferDialog(context);
            }
          }),
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
            'Recent Transactions',
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
              child: const Text("EXECUTE GATEWAY TRANSACTION", style: TextStyle(fontWeight: FontWeight.bold, letterSpacing: 1.1)),
            ),
            const SizedBox(height: 16),
            const Center(child: Text("OR", style: TextStyle(color: Colors.white24, fontWeight: FontWeight.bold))),
            const SizedBox(height: 16),
            OutlinedButton(
              onPressed: () {
                Navigator.pop(ctx);
                context.push('/wallet/virtual-account');
              },
              style: OutlinedButton.styleFrom(
                foregroundColor: Colors.white,
                side: const BorderSide(color: Colors.white24),
                padding: const EdgeInsets.symmetric(vertical: 18),
                shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
              ),
              child: const Text("FUND VIA LOCAL BANK TRANSFER", style: TextStyle(fontWeight: FontWeight.bold, letterSpacing: 1.1)),
            ),
          ],
        ),
      ),
    );
  }

  void _showTransferDialog(BuildContext context) {
    final recipientController = TextEditingController();
    final amountController = TextEditingController();
    String fromCurrency = 'USD';
    String toCurrency = 'USD';
    TransferPreview? preview;
    bool isLoadingPreview = false;
    bool isSending = false;

    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (ctx) => StatefulBuilder(
        builder: (context, setModalState) {
          Future<void> fetchPreview() async {
            final amount = double.tryParse(amountController.text);
            if (amount == null || amount <= 0) return;
            setModalState(() { isLoadingPreview = true; preview = null; });
            try {
              final result = await ref.read(walletControllerProvider.notifier).previewTransfer(
                amount: amount, fromCurrency: fromCurrency, toCurrency: toCurrency,
              );
              setModalState(() { preview = result; isLoadingPreview = false; });
            } catch (e) {
              setModalState(() { isLoadingPreview = false; });
              if (context.mounted) {
                ScaffoldMessenger.of(context).showSnackBar(
                  SnackBar(content: Text('$e'), backgroundColor: Colors.red),
                );
              }
            }
          }

          return Container(
            padding: EdgeInsets.fromLTRB(24, 24, 24, MediaQuery.of(ctx).viewInsets.bottom + 24),
            decoration: const BoxDecoration(
              color: Color(0xFF001540),
              borderRadius: BorderRadius.vertical(top: Radius.circular(32)),
            ),
            child: SingleChildScrollView(
              child: Column(
                mainAxisSize: MainAxisSize.min,
                crossAxisAlignment: CrossAxisAlignment.stretch,
                children: [
                  Row(
                    children: [
                      const Expanded(
                        child: Text("Transfer Funds",
                          style: TextStyle(color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold)),
                      ),
                      IconButton(icon: const Icon(Icons.close, color: Colors.white38), onPressed: () => Navigator.pop(ctx)),
                    ],
                  ),
                  const SizedBox(height: 16),
                  // Recipient
                  TextField(
                    controller: recipientController,
                    style: const TextStyle(color: Colors.white),
                    decoration: InputDecoration(
                      labelText: "Recipient Email or Phone",
                      labelStyle: const TextStyle(color: Color(0xFFFFD700)),
                      prefixIcon: const Icon(Icons.person_search, color: Color(0xFFFFD700)),
                      filled: true, fillColor: Colors.white.withOpacity(0.05),
                      border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
                    ),
                  ),
                  const SizedBox(height: 16),
                  // Amount + Currency selectors
                  Row(children: [
                    Expanded(flex: 2, child: TextField(
                      controller: amountController,
                      keyboardType: const TextInputType.numberWithOptions(decimal: true),
                      style: const TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold),
                      decoration: InputDecoration(
                        labelText: "You send", labelStyle: const TextStyle(color: Color(0xFFFFD700)),
                        filled: true, fillColor: Colors.white.withOpacity(0.05),
                        border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
                      ),
                    )),
                    const SizedBox(width: 12),
                    _buildCurrencyDropdown(fromCurrency, (v) => setModalState(() { fromCurrency = v!; preview = null; })),
                  ]),
                  const SizedBox(height: 8),
                  const Center(child: Icon(Icons.arrow_downward_rounded, color: Colors.white24, size: 20)),
                  const SizedBox(height: 8),
                  Row(children: [
                    const Expanded(flex: 2, child: Padding(
                      padding: EdgeInsets.symmetric(horizontal: 16),
                      child: Text("They receive", style: TextStyle(color: Colors.white38, fontSize: 13)),
                    )),
                    _buildCurrencyDropdown(toCurrency, (v) => setModalState(() { toCurrency = v!; preview = null; })),
                  ]),
                  const SizedBox(height: 16),
                  // Preview button
                  OutlinedButton.icon(
                    onPressed: isLoadingPreview ? null : fetchPreview,
                    icon: isLoadingPreview
                        ? const SizedBox(width: 16, height: 16, child: CircularProgressIndicator(strokeWidth: 2, color: Color(0xFFFFD700)))
                        : const Icon(Icons.calculate_outlined),
                    label: Text(preview != null ? 'REFRESH QUOTE' : 'GET QUOTE'),
                    style: OutlinedButton.styleFrom(
                      foregroundColor: const Color(0xFFFFD700),
                      side: const BorderSide(color: Color(0xFFFFD700)),
                      padding: const EdgeInsets.symmetric(vertical: 14),
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                    ),
                  ),
                  // Fee breakdown card
                  if (preview != null) ...[
                    const SizedBox(height: 16),
                    Container(
                      padding: const EdgeInsets.all(16),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.03),
                        borderRadius: BorderRadius.circular(16),
                        border: Border.all(color: const Color(0xFFFFD700).withOpacity(0.2)),
                      ),
                      child: Column(crossAxisAlignment: CrossAxisAlignment.start, children: [
                        _feeRow('You send', '${preview!.sendAmount.toStringAsFixed(2)} ${preview!.sendCurrency}', bold: true),
                        const Divider(color: Colors.white12, height: 20),
                        _feeRow('Transfer fee', '- ${preview!.transferFee.toStringAsFixed(2)} ${preview!.sendCurrency}'),
                        if (preview!.isCrossCurrency) ...[
                          _feeRow('Exchange rate', preview!.exchangeRateDisplay),
                          _feeRow('FX markup', '${preview!.fxMarkupAmount.toStringAsFixed(2)} ${preview!.receiveCurrency}'),
                        ],
                        const Divider(color: Colors.white12, height: 20),
                        _feeRow('Recipient gets', '${preview!.receiveAmount.toStringAsFixed(2)} ${preview!.receiveCurrency}',
                            bold: true, valueColor: const Color(0xFF4CAF50)),
                      ]),
                    ),
                  ],
                  const SizedBox(height: 20),
                  // Send button
                  ElevatedButton(
                    onPressed: (preview == null || isSending) ? null : () async {
                      final recipient = recipientController.text.trim();
                      if (recipient.isEmpty) return;
                      setModalState(() => isSending = true);
                      try {
                        await ref.read(walletControllerProvider.notifier).transfer(
                          recipientIdentifier: recipient,
                          amount: preview!.sendAmount,
                          fromCurrency: fromCurrency,
                          toCurrency: toCurrency,
                        );
                        if (context.mounted) {
                          Navigator.pop(ctx);
                          ScaffoldMessenger.of(context).showSnackBar(
                            const SnackBar(content: Text('Transfer successful!'), backgroundColor: Colors.green),
                          );
                        }
                      } catch (e) {
                        setModalState(() => isSending = false);
                        if (context.mounted) {
                          ScaffoldMessenger.of(context).showSnackBar(
                            SnackBar(content: Text('Transfer failed: $e'), backgroundColor: Colors.red),
                          );
                        }
                      }
                    },
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFFFFD700),
                      foregroundColor: const Color(0xFF001540),
                      disabledBackgroundColor: Colors.white10,
                      padding: const EdgeInsets.symmetric(vertical: 18),
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                    ),
                    child: isSending
                        ? const SizedBox(width: 20, height: 20, child: CircularProgressIndicator(strokeWidth: 2))
                        : const Text("CONFIRM & SEND", style: TextStyle(fontWeight: FontWeight.bold, letterSpacing: 1.1)),
                  ),
                ],
              ),
            ),
          );
        },
      ),
    );
  }

  Widget _buildCurrencyDropdown(String value, ValueChanged<String?> onChanged) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 12),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(16),
      ),
      child: DropdownButton<String>(
        value: value,
        dropdownColor: const Color(0xFF001540),
        underline: const SizedBox(),
        style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
        onChanged: onChanged,
        items: ['USD', 'NGN', 'CNY'].map((c) => DropdownMenuItem(value: c, child: Text(c))).toList(),
      ),
    );
  }

  Widget _feeRow(String label, String value, {bool bold = false, Color? valueColor}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 3),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Text(label, style: TextStyle(color: Colors.white54, fontSize: 13, fontWeight: bold ? FontWeight.bold : FontWeight.normal)),
          Text(value, style: TextStyle(color: valueColor ?? Colors.white, fontSize: 13, fontWeight: bold ? FontWeight.bold : FontWeight.normal)),
        ],
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
