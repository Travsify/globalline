
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../providers/supplier_payment_provider.dart';
import 'package:intl/intl.dart';

class SupplierPaymentListScreen extends ConsumerStatefulWidget {
  const SupplierPaymentListScreen({super.key});

  @override
  ConsumerState<SupplierPaymentListScreen> createState() => _SupplierPaymentListScreenState();
}

class _SupplierPaymentListScreenState extends ConsumerState<SupplierPaymentListScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      ref.read(supplierPaymentControllerProvider.notifier).fetchPayments();
    });
  }

  @override
  Widget build(BuildContext context) {
    final state = ref.watch(supplierPaymentControllerProvider);

    return Scaffold(
      backgroundColor: const Color(0xFFF5F7FA),
      appBar: AppBar(
        title: const Text('Supplier Payments', style: TextStyle(color: Color(0xFF002366), fontWeight: FontWeight.bold)),
        backgroundColor: Colors.white,
        elevation: 0,
        iconTheme: const IconThemeData(color: Color(0xFF002366)),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () => context.pop(),
        ),
      ),
      body: state.isLoading && state.payments.isEmpty
          ? const Center(child: CircularProgressIndicator())
          : state.payments.isEmpty
              ? _buildEmptyState()
              : ListView.builder(
                  padding: const EdgeInsets.all(16),
                  itemCount: state.payments.length,
                  itemBuilder: (context, index) {
                    final payment = state.payments[index];
                    return _buildPaymentCard(payment);
                  },
                ),
      floatingActionButton: FloatingActionButton(
        onPressed: () => context.push('/payments/log'),
        backgroundColor: const Color(0xFF002366),
        child: const Icon(Icons.add, color: Colors.white),
      ),
    );
  }

  Widget _buildEmptyState() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.payment_outlined, size: 80, color: Colors.grey[400]),
          const SizedBox(height: 16),
          Text(
            'No Payments Logged',
            style: TextStyle(fontSize: 18, color: Colors.grey[600], fontWeight: FontWeight.bold),
          ),
          const SizedBox(height: 8),
          Text(
            'Keep track of your supplier payments here.',
            style: TextStyle(color: Colors.grey[500]),
          ),
        ],
      ),
    );
  }

  Widget _buildPaymentCard(dynamic payment) {
    final currency = payment['currency'] ?? 'USD';
    final amount = double.tryParse(payment['amount']?.toString() ?? '0') ?? 0.0;
    final date = DateTime.tryParse(payment['created_at']) ?? DateTime.now();
    final status = payment['status'] ?? 'pending';

    return Card(
      margin: const EdgeInsets.only(bottom: 12),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      elevation: 2,
      child: ListTile(
        contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
        leading: Container(
          padding: const EdgeInsets.all(10),
          decoration: BoxDecoration(
            color: const Color(0xFF002366).withOpacity(0.1),
            shape: BoxShape.circle,
          ),
          child: const Icon(Icons.outbound, color: Color(0xFF002366)),
        ),
        title: Text(
          payment['supplier_name'] ?? 'Unknown Supplier',
          style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
        ),
        subtitle: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const SizedBox(height: 4),
            Text(DateFormat('MMM dd, yyyy').format(date), style: TextStyle(color: Colors.grey[600], fontSize: 12)),
            if (payment['notes'] != null)
              Text(payment['notes'], maxLines: 1, overflow: TextOverflow.ellipsis, style: TextStyle(color: Colors.grey[500], fontSize: 11)),
          ],
        ),
        trailing: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.end,
          children: [
            Text(
              '$currency ${amount.toStringAsFixed(2)}',
              style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
            ),
            const SizedBox(height: 4),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
              decoration: BoxDecoration(
                color: status == 'completed' ? Colors.green.withOpacity(0.1) : Colors.orange.withOpacity(0.1),
                borderRadius: BorderRadius.circular(8),
              ),
              child: Text(
                status.toUpperCase(),
                style: TextStyle(
                  color: status == 'completed' ? Colors.green : Colors.orange,
                  fontSize: 10,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
