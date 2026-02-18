import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/wallet/presentation/providers/wallet_provider.dart';
import 'package:mobile/features/wallet/data/models/wallet_models.dart';
import 'package:mobile/shared/widgets/status_widgets.dart';

class WalletScreen extends ConsumerWidget {
  const WalletScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final walletAsync = ref.watch(walletControllerProvider);

    return Scaffold(
      appBar: AppBar(title: const Text('My Wallet')),
      body: walletAsync.when(
        data: (wallet) => RefreshIndicator(
          onRefresh: () async {
            await ref.read(walletControllerProvider.notifier).refresh();
          },
          child: ListView(
            padding: const EdgeInsets.all(16.0),
            children: [
              SizedBox(
                height: 180,
                child: ListView(
                  scrollDirection: Axis.horizontal,
                  children: [
                    _BalanceCard(label: "USD Balance", amount: "\$1,245.00", color: Colors.blue[900]!),
                    _BalanceCard(label: "CNY Balance", amount: "¥8,450.00", color: Colors.red[900]!),
                    _BalanceCard(label: "NGN Balance", amount: "₦1,800,000", color: Colors.green[900]!),
                  ],
                ),
              ),
              const SizedBox(height: 24),
              const Text('Transactions', 
                style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold, color: Colors.white)),
              const SizedBox(height: 16),
              ...wallet.transactions.map((tx) => _TransactionTile(transaction: tx)),
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
}

class _BalanceCard extends StatelessWidget {
  final String label;
  final String amount;
  final Color color;
  const _BalanceCard({required this.label, required this.amount, required this.color});

  @override
  Widget build(BuildContext context) {
    return Container(
      width: 280,
      margin: const EdgeInsets.only(right: 15),
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: color,
        borderRadius: BorderRadius.circular(30),
        boxShadow: [BoxShadow(color: color.withOpacity(0.3), blurRadius: 15, offset: const Offset(0, 8))],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Text(label, style: const TextStyle(color: Colors.white60, fontWeight: FontWeight.bold, fontSize: 12)),
          const SizedBox(height: 10),
          Text(amount, style: const TextStyle(color: Colors.white, fontSize: 28, fontWeight: FontWeight.bold)),
        ],
      ),
    );
  }
}

class _TransactionTile extends StatelessWidget {
  final WalletTransaction transaction;
  const _TransactionTile({required this.transaction});

  @override
  Widget build(BuildContext context) {
    final isCredit = transaction.type == 'Credit';
    return Card(
      child: ListTile(
        leading: CircleAvatar(
          backgroundColor: isCredit ? Colors.green[100] : Colors.red[100],
          child: Icon(
            isCredit ? Icons.arrow_downward : Icons.arrow_upward,
            color: isCredit ? Colors.green : Colors.red,
          ),
        ),
        title: Text(transaction.description),
        subtitle: Text(transaction.date.toString().split(' ')[0]),
        trailing: Text(
          '${isCredit ? '+' : '-'} ${transaction.amount.toStringAsFixed(2)}',
          style: TextStyle(
            color: isCredit ? Colors.green : Colors.red,
            fontWeight: FontWeight.bold,
          ),
        ),
      ),
    );
  }
}
