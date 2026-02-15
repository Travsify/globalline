import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/addresses/data/models/address_model.dart';
import 'package:mobile/features/addresses/data/repositories/address_repository.dart';
import 'package:mobile/features/addresses/presentation/screens/add_edit_address_screen.dart';

class AddressListScreen extends ConsumerWidget {
  const AddressListScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final addressesAsync = ref.watch(addressesProvider);

    return Scaffold(
      appBar: AppBar(
        title: const Text('Saved Addresses'),
        actions: [
          IconButton(
            icon: const Icon(Icons.add), 
            onPressed: () => Navigator.push(
              context, 
              MaterialPageRoute(builder: (_) => const AddEditAddressScreen())
            )
          ),
        ],
      ),
      body: addressesAsync.when(
        data: (addresses) => RefreshIndicator(
          onRefresh: () async => ref.invalidate(addressesProvider),
          child: ListView.separated(
            padding: const EdgeInsets.all(16),
            itemCount: addresses.length,
            separatorBuilder: (context, index) => const SizedBox(height: 16),
            itemBuilder: (context, index) {
              final address = addresses[index];
              return Card(
                child: InkWell(
                  onTap: () => Navigator.push(
                    context, 
                    MaterialPageRoute(builder: (_) => AddEditAddressScreen(address: address))
                  ),
                  child: Padding(
                    padding: const EdgeInsets.all(16.0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Row(
                          children: [
                            Icon(
                              address.label.toLowerCase() == "home" ? Icons.home : Icons.work, 
                              color: Theme.of(context).colorScheme.primary
                            ),
                            const SizedBox(width: 8),
                            Text(address.label, style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16)),
                            if (address.isDefault) ...[
                              const SizedBox(width: 8),
                              Container(
                                padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
                                decoration: BoxDecoration(color: Colors.green[100], borderRadius: BorderRadius.circular(4)),
                                child: const Text("Default", style: TextStyle(color: Colors.green, fontSize: 10, fontWeight: FontWeight.bold)),
                              )
                            ],
                            const Spacer(),
                            PopupMenuButton(
                              itemBuilder: (context) => [
                                const PopupMenuItem(value: 'edit', child: Text('Edit')),
                                const PopupMenuItem(value: 'delete', child: Text('Delete', style: TextStyle(color: Colors.red))),
                              ],
                              onSelected: (value) async {
                                if (value == 'edit') {
                                  Navigator.push(
                                    context, 
                                    MaterialPageRoute(builder: (_) => AddEditAddressScreen(address: address))
                                  );
                                } else if (value == 'delete') {
                                  final confirmed = await showDialog<bool>(
                                    context: context,
                                    builder: (context) => AlertDialog(
                                      title: const Text('Delete Address'),
                                      content: const Text('Are you sure you want to delete this address?'),
                                      actions: [
                                        TextButton(onPressed: () => Navigator.pop(context, false), child: const Text('Cancel')),
                                        TextButton(onPressed: () => Navigator.pop(context, true), child: const Text('Delete', style: TextStyle(color: Colors.red))),
                                      ],
                                    ),
                                  );
                                  if (confirmed == true) {
                                    await ref.read(addressRepositoryProvider).deleteAddress(address.id!);
                                    ref.invalidate(addressesProvider);
                                  }
                                }
                              },
                            ),
                          ],
                        ),
                        const Divider(),
                        Text(address.recipientName, style: const TextStyle(fontWeight: FontWeight.bold)),
                        const SizedBox(height: 4),
                        Text(address.street),
                        Text('${address.city}${address.zipCode != null ? ', ${address.zipCode}' : ''}'),
                        Text(address.country),
                        const SizedBox(height: 8),
                        Text(address.phone, style: TextStyle(color: Colors.grey[600])),
                      ],
                    ),
                  ),
                ),
              );
            },
          ),
        ),
        loading: () => const Center(child: CircularProgressIndicator()),
        error: (err, stack) => Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Text('Error: $err'),
              ElevatedButton(
                onPressed: () => ref.invalidate(addressesProvider),
                child: const Text('Retry'),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
