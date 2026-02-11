import 'package:connectivity_plus/connectivity_plus.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';

enum ConnectivityStatus { isConnected, isDisconnected }

class ConnectivityService extends Notifier<ConnectivityStatus> {
  @override
  ConnectivityStatus build() {
    _listenToConnectivity();
    return ConnectivityStatus.isConnected;
  }

  void _listenToConnectivity() {
    Connectivity().onConnectivityChanged.listen((result) {
      if (result.contains(ConnectivityResult.none)) {
        state = ConnectivityStatus.isDisconnected;
      } else {
        state = ConnectivityStatus.isConnected;
      }
    });
  }
}

final connectivityProvider = NotifierProvider<ConnectivityService, ConnectivityStatus>(ConnectivityService.new);
