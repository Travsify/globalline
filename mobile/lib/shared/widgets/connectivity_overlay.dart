
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:mobile/core/services/connectivity_service.dart';

class ConnectivityOverlay extends ConsumerWidget {
  final Widget child;

  const ConnectivityOverlay({super.key, required this.child});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final status = ref.watch(connectivityProvider);

    return Stack(
      children: [
        child,
        if (status == ConnectivityStatus.isDisconnected)
          Positioned(
            top: 0,
            left: 0,
            right: 0,
            child: Material(
              child: Container(
                color: Colors.red,
                padding: const EdgeInsets.symmetric(vertical: 8),
                child: const SafeArea(
                  bottom: false,
                  child: Center(
                    child: Text(
                      'No Internet Connection',
                      style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
                    ),
                  ),
                ),
              ),
            ),
          ),
      ],
    );
  }
}
