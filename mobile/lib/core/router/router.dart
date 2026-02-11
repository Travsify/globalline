import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';

import 'package:mobile/features/auth/presentation/screens/login_screen.dart';
import 'package:mobile/features/auth/presentation/screens/register_screen.dart';

// TODO: Import actual screens when created
import 'package:mobile/features/home/presentation/screens/home_screen.dart';
import 'package:mobile/features/tracking/presentation/screens/tracking_screen.dart';
import 'package:mobile/features/profile/presentation/screens/profile_screen.dart';
import 'package:mobile/shared/widgets/scaffold_with_navbar.dart';
import 'package:mobile/features/logistics/presentation/screens/shipping_calculator_screen.dart';
import 'package:mobile/features/logistics/presentation/screens/create_shipment_screen.dart';
import 'package:mobile/features/orders/presentation/screens/order_history_screen.dart';
import 'package:mobile/features/addresses/presentation/screens/address_list_screen.dart';
import 'package:mobile/features/notifications/presentation/screens/notification_screen.dart';

import 'package:mobile/features/marketplace/presentation/screens/marketplace_screen.dart';
import 'package:mobile/features/marketplace/presentation/screens/product_details_screen.dart';
import 'package:mobile/features/marketplace/presentation/screens/cart_screen.dart';
import 'package:mobile/features/marketplace/presentation/screens/checkout_screen.dart';

import 'package:mobile/features/wallet/presentation/screens/wallet_screen.dart';

import 'package:mobile/features/onboarding/presentation/screens/splash_screen.dart';
import 'package:mobile/features/onboarding/presentation/screens/onboarding_screen.dart';

final routerProvider = Provider<GoRouter>((ref) {
  final rootNavigatorKey = GlobalKey<NavigatorState>();
  final shellNavigatorKey = GlobalKey<NavigatorState>();

  return GoRouter(
    navigatorKey: rootNavigatorKey,
    initialLocation: '/splash',
    routes: [
      GoRoute(
        path: '/splash',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) => const SplashScreen(),
      ),
      GoRoute(
        path: '/onboarding',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) => const OnboardingScreen(),
      ),
      GoRoute(
        path: '/login',
        builder: (context, state) => const LoginScreen(),
      ),
      GoRoute(
        path: '/register',
        builder: (context, state) => const RegisterScreen(),
      ),
      GoRoute(
        path: '/wallet',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) => const WalletScreen(),
      ),
      GoRoute(
        path: '/calculator',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) => const ShippingCalculatorScreen(),
      ),
      GoRoute(
        path: '/ship/create',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) => const CreateShipmentScreen(),
      ),
      GoRoute(
        path: '/product/:id',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) {
           final id = state.pathParameters['id']!;
           return ProductDetailsScreen(productId: id);
        },
      ),
      GoRoute(
        path: '/cart',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) => const CartScreen(),
      ),
      GoRoute(
        path: '/checkout',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) => const CheckoutScreen(),
      ),
      GoRoute(
        path: '/orders',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) => const OrderHistoryScreen(),
      ),
      GoRoute(
        path: '/addresses',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) => const AddressListScreen(),
      ),
      GoRoute(
        path: '/notifications',
        parentNavigatorKey: rootNavigatorKey,
        builder: (context, state) => const NotificationScreen(),
      ),
      ShellRoute(
        navigatorKey: shellNavigatorKey,
        builder: (context, state, child) {
          return ScaffoldWithNavbar(child: child);
        },
        routes: [
          GoRoute(
            path: '/home',
            builder: (context, state) => const HomeScreen(),
          ),
          GoRoute(
            path: '/tracking',
            builder: (context, state) => const TrackingScreen(),
          ),
          GoRoute(
            path: '/shop',
            builder: (context, state) => const MarketplaceScreen(),
          ),
          GoRoute(
            path: '/profile',
            builder: (context, state) => const ProfileScreen(),
          ),
        ],
      ),
    ],
  );
});
