import 'package:dio/dio.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';
import 'package:mobile/features/support/data/models/support_model.dart';

abstract class SupportRepository {
  Future<List<SupportTicket>> getTickets();
  Future<SupportTicket> createTicket(String subject, String category, String priority, String message);
  Future<SupportTicket> getTicketDetails(int id);
  Future<SupportMessage> replyToTicket(int ticketId, String message);
}

class RealSupportRepository implements SupportRepository {
  final Dio _dio;
  RealSupportRepository(this._dio);

  @override
  Future<List<SupportTicket>> getTickets() async {
    final response = await _dio.get('support/tickets');
    return (response.data as List).map((e) => SupportTicket.fromJson(e)).toList();
  }

  @override
  Future<SupportTicket> createTicket(String subject, String category, String priority, String message) async {
    final response = await _dio.post('support/tickets', data: {
      'subject': subject,
      'category': category,
      'priority': priority,
      'message': message,
    });
    return SupportTicket.fromJson(response.data);
  }

  @override
  Future<SupportTicket> getTicketDetails(int id) async {
    final response = await _dio.get('support/tickets/$id');
    return SupportTicket.fromJson(response.data);
  }

  @override
  Future<SupportMessage> replyToTicket(int ticketId, String message) async {
    final response = await _dio.post('support/tickets/$ticketId/reply', data: {
      'message': message,
    });
    return SupportMessage.fromJson(response.data);
  }
}

final supportRepositoryProvider = Provider<SupportRepository>((ref) {
  return RealSupportRepository(ref.watch(dioProvider));
});

final ticketsProvider = FutureProvider.autoDispose<List<SupportTicket>>((ref) async {
  return ref.watch(supportRepositoryProvider).getTickets();
});

final ticketDetailsProvider = FutureProvider.autoDispose.family<SupportTicket, int>((ref, id) async {
  return ref.watch(supportRepositoryProvider).getTicketDetails(id);
});
