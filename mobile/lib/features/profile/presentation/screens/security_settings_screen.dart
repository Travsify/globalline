import 'package:flutter/material.dart';

class SecuritySettingsScreen extends StatelessWidget {
  const SecuritySettingsScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF001540),
      appBar: AppBar(
        title: const Text('Security & Privacy', 
          style: TextStyle(fontFamily: 'Outfit', fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
      ),
      body: ListView(
        padding: const EdgeInsets.all(24),
        children: [
          _buildSecurityCard(
            context,
            'Transaction PIN',
            'Protect your transfers and payouts with a secure PIN.',
            Icons.pin_outlined,
            () {}, // TODO: PIN management
          ),
          const SizedBox(height: 16),
          _buildSecurityCard(
            context,
            'Biometrics',
            'Use FaceID or TouchID for quick and secure access.',
            Icons.fingerprint,
            () {}, // TODO: Biometric management
          ),
          const SizedBox(height: 16),
          _buildSecurityCard(
            context,
            'Device Management',
            'View and manage devices where you are logged in.',
            Icons.devices,
            () {},
          ),
        ],
      ),
    );
  }

  Widget _buildSecurityCard(BuildContext context, String title, String subtitle, IconData icon, VoidCallback onTap) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.05),
        borderRadius: BorderRadius.circular(20),
        border: Border.all(color: Colors.white.withOpacity(0.1)),
      ),
      child: ListTile(
        onTap: onTap,
        contentPadding: const EdgeInsets.all(20),
        leading: Container(
          padding: const EdgeInsets.all(12),
          decoration: BoxDecoration(
            color: const Color(0xFFFFD700).withOpacity(0.1),
            shape: BoxShape.circle,
          ),
          child: Icon(icon, color: const Color(0xFFFFD700), size: 24),
        ),
        title: Text(title, 
          style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 16)),
        subtitle: Padding(
          padding: const EdgeInsets.only(top: 4),
          child: Text(subtitle, 
            style: const TextStyle(color: Colors.white54, fontSize: 12)),
        ),
        trailing: const Icon(Icons.chevron_right, color: Colors.white24),
      ),
    );
  }
}
