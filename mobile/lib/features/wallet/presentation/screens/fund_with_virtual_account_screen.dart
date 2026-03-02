import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';
import 'package:mobile/shared/widgets/status_widgets.dart';

class FundWithVirtualAccountScreen extends ConsumerStatefulWidget {
  const FundWithVirtualAccountScreen({super.key});

  @override
  ConsumerState<FundWithVirtualAccountScreen> createState() => _FundWithVirtualAccountScreenState();
}

class _FundWithVirtualAccountScreenState extends ConsumerState<FundWithVirtualAccountScreen> {
  late Future<Map<String, dynamic>> _accountFuture;

  @override
  void initState() {
    super.initState();
    _accountFuture = _fetchVirtualAccount();
  }

  Future<Map<String, dynamic>> _fetchVirtualAccount() async {
    final dio = ref.read(dioProvider);
    final response = await dio.get('/wallet/virtual-account');
    return response.data['data'];
  }

  void _copyToClipboard(String text, String label) {
    Clipboard.setData(ClipboardData(text: text));
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text('$label copied to clipboard')),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF001540),
      appBar: AppBar(
        title: const Text("Fund via Bank Transfer", style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
      ),
      body: FutureBuilder<Map<String, dynamic>>(
        future: _accountFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const AppLoadingWidget();
          }
          if (snapshot.hasError) {
            return AppErrorWidget(
              message: "Failed to load account details. Please try again later.",
              onRetry: () => setState(() => _accountFuture = _fetchVirtualAccount()),
            );
          }

          final account = snapshot.data!;
          return SingleChildScrollView(
            padding: const EdgeInsets.all(24),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                const Icon(Icons.account_balance_rounded, size: 64, color: Color(0xFFFFD700)),
                const SizedBox(height: 24),
                const Text(
                  "Your Permanent Virtual Account",
                  textAlign: TextAlign.center,
                  style: TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold),
                ),
                const SizedBox(height: 8),
                const Text(
                  "Transfer any amount to the account below. Your wallet will be credited automatically once the transaction is cleared.",
                  textAlign: TextAlign.center,
                  style: TextStyle(color: Colors.white54, fontSize: 13),
                ),
                const SizedBox(height: 40),
                _buildInfoCard(
                  label: "BANK NAME",
                  value: account['bank_name'] ?? 'N/A',
                ),
                const SizedBox(height: 16),
                _buildInfoCard(
                  label: "ACCOUNT NUMBER",
                  value: account['account_number'] ?? 'N/A',
                  showCopy: true,
                ),
                const SizedBox(height: 16),
                _buildInfoCard(
                  label: "ACCOUNT NAME",
                  value: account['account_name'] ?? 'N/A',
                ),
                const SizedBox(height: 48),
                Container(
                  padding: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.05),
                    borderRadius: BorderRadius.circular(16),
                    border: Border.all(color: Colors.white.withOpacity(0.1)),
                  ),
                  child: const Row(
                    children: [
                      Icon(Icons.info_outline, color: Color(0xFFFFD700), size: 20),
                      SizedBox(width: 12),
                      Expanded(
                        child: Text(
                          "Transactions typically clear within 2-5 minutes. For support, please contact our financial node operators.",
                          style: TextStyle(color: Colors.white70, fontSize: 12),
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          );
        },
      ),
    );
  }

  Widget _buildInfoCard({required String label, required String value, bool showCopy = false}) {
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(20),
        border: Border.all(color: Colors.white.withOpacity(0.05)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(label, style: const TextStyle(color: Color(0xFFFFD700), fontSize: 10, fontWeight: FontWeight.bold, letterSpacing: 1.1)),
          const SizedBox(height: 8),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Expanded(
                child: Text(
                  value,
                  style: const TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.w600, fontFamily: 'Outfit'),
                ),
              ),
              if (showCopy)
                IconButton(
                  icon: const Icon(Icons.copy_rounded, color: Colors.white54, size: 20),
                  onPressed: () => _copyToClipboard(value, label),
                ),
            ],
          ),
        ],
      ),
    );
  }
}
