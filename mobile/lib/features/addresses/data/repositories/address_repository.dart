import 'package:dio/dio.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';
import 'package:mobile/features/addresses/data/models/address_model.dart';

abstract class AddressRepository {
  Future<List<Address>> getAddresses();
  Future<Address> createAddress(Address address);
  Future<Address> updateAddress(Address address);
  Future<void> deleteAddress(int id);
}

class RealAddressRepository implements AddressRepository {
  final Dio _dio;
  RealAddressRepository(this._dio);

  @override
  Future<List<Address>> getAddresses() async {
    final response = await _dio.get('addresses');
    return (response.data as List).map((e) => Address.fromJson(e)).toList();
  }

  @override
  Future<Address> createAddress(Address address) async {
    final response = await _dio.post('addresses', data: address.toJson());
    return Address.fromJson(response.data);
  }

  @override
  Future<Address> updateAddress(Address address) async {
    final response = await _dio.put('addresses/${address.id}', data: address.toJson());
    return Address.fromJson(response.data);
  }

  @override
  Future<void> deleteAddress(int id) async {
    await _dio.delete('addresses/$id');
  }
}

final addressRepositoryProvider = Provider<AddressRepository>((ref) {
  return RealAddressRepository(ref.watch(dioProvider));
});

final addressesProvider = FutureProvider.autoDispose<List<Address>>((ref) async {
  final repository = ref.watch(addressRepositoryProvider);
  return repository.getAddresses();
});
