import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/network/api_client.dart';
import 'package:dio/dio.dart';

class AiSourcingState {
  final List<Map<String, dynamic>> messages;
  final bool isLoading;
  final String? error;

  AiSourcingState({
    required this.messages,
    this.isLoading = false,
    this.error,
  });

  AiSourcingState copyWith({
    List<Map<String, dynamic>>? messages,
    bool? isLoading,
    String? error,
  }) {
    return AiSourcingState(
      messages: messages ?? this.messages,
      isLoading: isLoading ?? this.isLoading,
      error: error ?? this.error,
    );
  }
}

class AiSourcingNotifier extends Notifier<AiSourcingState> {
  late final Dio _dio;

  @override
  AiSourcingState build() {
    _dio = ref.watch(dioProvider);
    return AiSourcingState(messages: [
      {
        'isAi': true,
        'text': 'CONNECTION ESTABLISHED. I am your GlobalLine Sourcing Assistant. I have active pipelines to Shenzhen, Istanbul, and Dubai. What procurement channel shall we activate today?',
      }
    ]);
  }

  Future<void> sendMessage(String text) async {
    final userMessage = {'isAi': false, 'text': text};
    state = state.copyWith(
      messages: [...state.messages, userMessage],
      isLoading: true,
      error: null,
    );

    try {
      final response = await _dio.post('ai/sourcing/chat', data: {'message': text});
      
      if (response.statusCode == 200) {
        final data = response.data['data'];
        final aiMessage = {
          'isAi': true,
          'text': data['text'],
          'hasAction': (data['products'] as List).isNotEmpty,
          'products': data['products'],
          'suggestions': data['suggestions'],
        };
        
        state = state.copyWith(
          messages: [...state.messages, aiMessage],
          isLoading: false,
        );
      } else {
        throw Exception('Failed to get response');
      }
    } catch (e) {
      state = state.copyWith(
        isLoading: false,
        error: "COMMUNICATION ERROR: Unable to reach the sourcing node.",
      );
    }
  }
}

final aiSourcingProvider = NotifierProvider<AiSourcingNotifier, AiSourcingState>(AiSourcingNotifier.new);
