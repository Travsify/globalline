import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/features/addresses/data/models/address_model.dart';

abstract class AddressRepository {
  Future<List<Address>> getAddresses();
}

class MockAddressRepository implements AddressRepository {
  @override
  Future<List<Address>> getAddresses() async {
    await Future.delayed(const Duration(seconds: 1));
    return [
      Address(
        id: "ADDR_1",
        label: "Home",
        recipientName: "John Doe",
        street: "123 Main St, Apt 4B",
        city: "New York",
        country: "USA",
        zip: "10001",
        phone: "+1 555-0123",
        isDefault: true,
      ),
      Address(
        id: "ADDR_2",
        label: "Office",
        recipientName: "John Doe",
        street: "456 Market St, Suite 500",
        city: "San Francisco",
        country: "USA",
        zip: "94105",
        phone: "+1 555-0987",
        isDefault: false,
      ),
    ];
  }
}

final addressRepositoryProvider = Provider<AddressRepository>((ref) {
  return MockAddressRepository();
});

final addressesProvider = FutureProvider.autoDispose<List<Address>>((ref) async {
  final repository = ref.watch(addressRepositoryProvider);
  return repository.getAddresses();
});
