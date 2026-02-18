import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:mobile/features/addresses/presentation/screens/address_list_screen.dart';
import 'package:mobile/features/support/presentation/screens/support_ticket_list_screen.dart';
import 'package:mobile/features/kyc/presentation/screens/kyc_upload_screen.dart';
import 'package:mobile/features/loyalty/presentation/screens/loyalty_dashboard_screen.dart';

class ProfileScreen extends ConsumerWidget {
  const ProfileScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    return Scaffold(
      backgroundColor: const Color(0xFF002366),
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        title: const Text('My Profile', style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        centerTitle: true,
        actions: [
          IconButton(
            icon: const Icon(Icons.notifications_outlined, color: Colors.white),
            onPressed: () {},
          ),
          IconButton(
            icon: const Icon(Icons.settings_outlined, color: Colors.white),
            onPressed: () {},
          ),
        ],
      ),
      body: Stack(
        children: [
           // Background Gradient
          Positioned.fill(
             child: Container(
              decoration: const BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment.topCenter,
                  end: Alignment.bottomCenter,
                  colors: [
                    Color(0xFF002366),
                    Color(0xFF001540),
                  ],
                ),
              ),
            ),
          ),
          SingleChildScrollView(
            child: Column(
              children: [
                const SizedBox(height: 100), // Spacing for AppBar
                // Profile Header
                Center(
                  child: Column(
                    children: [
                      Container(
                        padding: const EdgeInsets.all(4),
                        decoration: BoxDecoration(
                          shape: BoxShape.circle,
                          border: Border.all(color: const Color(0xFFFFD700), width: 3),
                          boxShadow: [
                            BoxShadow(
                              color: const Color(0xFFFFD700).withOpacity(0.3),
                              blurRadius: 20,
                              spreadRadius: 5,
                            ),
                          ],
                        ),
                        child: const CircleAvatar(
                          radius: 50,
                          backgroundColor: Colors.white,
                          child: Icon(Icons.person, size: 60, color: Color(0xFF002366)),
                        ),
                      ),
                      const SizedBox(height: 16),
                      const Text(
                        "John Doe",
                        style: TextStyle(fontSize: 28, fontWeight: FontWeight.bold, color: Colors.white, fontFamily: 'Outfit'),
                      ),
                      const SizedBox(height: 8),
                      Container(
                        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 6),
                        decoration: BoxDecoration(
                          color: const Color(0xFFFFD700),
                          borderRadius: BorderRadius.circular(20),
                        ),
                        child: const Text(
                          "PRO MEMBER",
                          style: TextStyle(color: Color(0xFF002366), fontWeight: FontWeight.bold, fontSize: 12),
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 32),
                
                // Stats Row
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 24),
                  child: Row(
                    children: [
                      _buildStatCard("Shipments", "12", Icons.local_shipping),
                      const SizedBox(width: 16),
                      _buildStatCard("Wallet", "\$1.2k", Icons.account_balance_wallet),
                      const SizedBox(width: 16),
                      _buildStatCard("Points", "450", Icons.star),
                    ],
                  ),
                ),
                const SizedBox(height: 32),

                // Menu Items
                Container(
                  padding: const EdgeInsets.all(24),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.05),
                    borderRadius: const BorderRadius.vertical(top: Radius.circular(32)),
                  ),
                  child: Column(
                    children: [
                      _buildMenuItem(context, "My Orders", Icons.history, () => context.push('/orders')),
                      _buildMenuItem(context, "Edit Profile", Icons.person_outline, () => context.push('/profile/edit')),
                      _buildMenuItem(context, "Change Password", Icons.lock_outline, () => context.push('/profile/password')),
                      _buildMenuItem(context, "Saved Addresses", Icons.location_on, () => Navigator.push(context, MaterialPageRoute(builder: (_) => const AddressListScreen()))),
                      _buildMenuItem(context, "Loyalty & Tiers", Icons.stars, () => Navigator.push(context, MaterialPageRoute(builder: (_) => const LoyaltyDashboardScreen()))),
                      _buildMenuItem(context, "Payment Methods", Icons.credit_card, () {}),
                      Divider(color: Colors.white.withOpacity(0.1), height: 32),
                      _buildMenuItem(context, "Help & Support", Icons.help_outline, () => Navigator.push(context, MaterialPageRoute(builder: (_) => const SupportTicketListScreen()))),
                      _buildMenuItem(context, "KYC Verification", Icons.verified_user_outlined, () => Navigator.push(context, MaterialPageRoute(builder: (_) => const KycUploadScreen()))),
                      _buildMenuItem(context, "Privacy Policy", Icons.privacy_tip_outlined, () {}),
                      const SizedBox(height: 24),
                      TextButton(
                        onPressed: () {
                           // Logout logic would go here
                           context.go('/auth/login');
                        },
                        child: Text("Log Out", style: TextStyle(color: Colors.red[300], fontSize: 16)),
                      )
                    ],
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildStatCard(String label, String value, IconData icon) {
    return Expanded(
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 16),
        decoration: BoxDecoration(
          color: Colors.white.withOpacity(0.1),
          borderRadius: BorderRadius.circular(16),
          border: Border.all(color: Colors.white.withOpacity(0.1)),
        ),
        child: Column(
          children: [
            Icon(icon, color: const Color(0xFFFFD700), size: 24),
            const SizedBox(height: 8),
            Text(value, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 18, fontFamily: 'Outfit')),
            Text(label, style: TextStyle(color: Colors.white.withOpacity(0.6), fontSize: 12)),
          ],
        ),
      ),
    );
  }

  Widget _buildMenuItem(BuildContext context, String title, IconData icon, VoidCallback onTap) {
    return ListTile(
      contentPadding: const EdgeInsets.symmetric(vertical: 4),
      leading: Container(
        padding: const EdgeInsets.all(10),
        decoration: BoxDecoration(
          color: Colors.white.withOpacity(0.1),
          shape: BoxShape.circle,
        ),
        child: Icon(icon, color: Colors.white, size: 20),
      ),
      title: Text(title, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.w600, fontFamily: 'Outfit')),
      trailing: Icon(Icons.chevron_right, color: Colors.white.withOpacity(0.5)),
      onTap: onTap,
    );
  }
}
