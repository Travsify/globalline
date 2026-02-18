import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:math' as math;

class OnboardingScreen extends StatefulWidget {
  const OnboardingScreen({super.key});

  @override
  State<OnboardingScreen> createState() => _OnboardingScreenState();
}

class _OnboardingScreenState extends State<OnboardingScreen>
    with TickerProviderStateMixin {
  final PageController _pageController = PageController();
  int _currentPage = 0;
  late AnimationController _fadeController;
  late AnimationController _blobController;
  late Animation<double> _fadeAnimation;

  final List<OnboardingContent> _contents = [
    OnboardingContent(
      title: "Ship Anywhere,\nAnytime",
      description:
          "Send packages to 200+ countries with lightning-fast express delivery. Real-time optimization ensures your goods travel the smartest route.",
      icon: Icons.rocket_launch_rounded,
      accentColor: const Color(0xFFFFD700),
    ),
    OnboardingContent(
      title: "Track in\nReal-Time",
      description:
          "Follow every package on our live global network map. Know exactly where your shipment is, from warehouse to doorstep.",
      icon: Icons.track_changes_rounded,
      accentColor: const Color(0xFF00E5FF),
    ),
    OnboardingContent(
      title: "Source Like\na Titan",
      description:
          "Buy directly from 1688, Taobao, and TMall in your local currency. Access exclusive markets in China and beyond with zero hassle.",
      icon: Icons.storefront_rounded,
      accentColor: const Color(0xFF69F0AE),
    ),
    OnboardingContent(
      title: "Your Wallet,\nReimagined",
      description:
          "Manage multi-currency transactions with military-grade security. Fund, convert, and pay suppliers across the globe effortlessly.",
      icon: Icons.account_balance_wallet_rounded,
      accentColor: const Color(0xFFFFAB40),
    ),
    OnboardingContent(
      title: "Your Global\nAddress",
      description:
          "Get unique virtual shipping suites in the US, UK, China and more. Shop internationally and we'll forward it all to your door.",
      icon: Icons.public_rounded,
      accentColor: const Color(0xFFE040FB),
    ),
  ];

  @override
  void initState() {
    super.initState();
    _fadeController = AnimationController(
        vsync: this, duration: const Duration(milliseconds: 500));
    _blobController = AnimationController(
        vsync: this, duration: const Duration(seconds: 8))
      ..repeat();
    _fadeAnimation = Tween<double>(begin: 0.0, end: 1.0).animate(
        CurvedAnimation(parent: _fadeController, curve: Curves.easeIn));
    _fadeController.forward();
  }

  @override
  void dispose() {
    _fadeController.dispose();
    _blobController.dispose();
    _pageController.dispose();
    super.dispose();
  }

  void _onPageChanged(int index) {
    setState(() => _currentPage = index);
    _fadeController.reset();
    _fadeController.forward();
  }

  Future<void> _completeOnboarding() async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setBool('has_completed_onboarding', true);
    if (mounted) context.go('/login');
  }

  @override
  Widget build(BuildContext context) {
    final content = _contents[_currentPage];

    return Scaffold(
      body: Stack(
        children: [
          // === BACKGROUND: Full-screen dark gradient ===
          Positioned.fill(
            child: Container(
              decoration: const BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                  colors: [
                    Color(0xFF001540),
                    Color(0xFF002366),
                    Color(0xFF0D47A1),
                  ],
                  stops: [0.0, 0.5, 1.0],
                ),
              ),
            ),
          ),

          // === ANIMATED BLOBS ===
          AnimatedBuilder(
            animation: _blobController,
            builder: (context, child) {
              return Stack(
                children: [
                  // Blob 1: Top-right — pulsing gold
                  Positioned(
                    top: -80 + 20 * math.sin(_blobController.value * 2 * math.pi),
                    right: -60 + 15 * math.cos(_blobController.value * 2 * math.pi),
                    child: Container(
                      width: 280,
                      height: 280,
                      decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        gradient: RadialGradient(
                          colors: [
                            content.accentColor.withOpacity(0.15),
                            content.accentColor.withOpacity(0.0),
                          ],
                        ),
                      ),
                    ),
                  ),
                  // Blob 2: Bottom-left — drifting blue
                  Positioned(
                    bottom: -40 + 25 * math.cos(_blobController.value * 2 * math.pi),
                    left: -50 + 20 * math.sin(_blobController.value * 2 * math.pi),
                    child: Container(
                      width: 220,
                      height: 220,
                      decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        gradient: RadialGradient(
                          colors: [
                            const Color(0xFF0D47A1).withOpacity(0.2),
                            const Color(0xFF0D47A1).withOpacity(0.0),
                          ],
                        ),
                      ),
                    ),
                  ),
                  // Blob 3: Center — subtle accent
                  Positioned(
                    top: MediaQuery.of(context).size.height * 0.25,
                    left: MediaQuery.of(context).size.width * 0.1,
                    child: Container(
                      width: 180,
                      height: 180,
                      decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        gradient: RadialGradient(
                          colors: [
                            content.accentColor.withOpacity(0.08),
                            content.accentColor.withOpacity(0.0),
                          ],
                        ),
                      ),
                    ),
                  ),
                ],
              );
            },
          ),

          // === PAGE CONTENT ===
          SafeArea(
            child: Column(
              children: [
                // Skip button
                Padding(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 24, vertical: 16),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      if (_currentPage != _contents.length - 1)
                        TextButton(
                          onPressed: _completeOnboarding,
                          child: Container(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 20, vertical: 8),
                            decoration: BoxDecoration(
                              color: Colors.white.withOpacity(0.08),
                              borderRadius: BorderRadius.circular(20),
                              border: Border.all(
                                  color: Colors.white.withOpacity(0.15)),
                            ),
                            child: const Text(
                              "Skip",
                              style: TextStyle(
                                color: Colors.white70,
                                fontSize: 14,
                                fontWeight: FontWeight.w600,
                              ),
                            ),
                          ),
                        ),
                    ],
                  ),
                ),

                // Swipeable pages
                Expanded(
                  child: PageView.builder(
                    controller: _pageController,
                    itemCount: _contents.length,
                    onPageChanged: _onPageChanged,
                    itemBuilder: (context, index) {
                      return _OnboardingPage(
                        content: _contents[index],
                        fadeAnimation: _fadeAnimation,
                      );
                    },
                  ),
                ),

                // Bottom controls
                Padding(
                  padding: const EdgeInsets.fromLTRB(24, 0, 24, 48),
                  child: Column(
                    children: [
                      // Page indicators
                      Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: List.generate(
                          _contents.length,
                          (index) => AnimatedContainer(
                            duration: const Duration(milliseconds: 400),
                            curve: Curves.easeOutCubic,
                            margin: const EdgeInsets.symmetric(horizontal: 4),
                            height: 6,
                            width: _currentPage == index ? 36 : 6,
                            decoration: BoxDecoration(
                              color: _currentPage == index
                                  ? const Color(0xFFFFD700)
                                  : Colors.white.withOpacity(0.25),
                              borderRadius: BorderRadius.circular(3),
                              boxShadow: _currentPage == index
                                  ? [
                                      BoxShadow(
                                        color: const Color(0xFFFFD700)
                                            .withOpacity(0.4),
                                        blurRadius: 8,
                                      ),
                                    ]
                                  : null,
                            ),
                          ),
                        ),
                      ),
                      const SizedBox(height: 32),

                      // CTA Button
                      SizedBox(
                        width: double.infinity,
                        height: 58,
                        child: Container(
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(18),
                            gradient: const LinearGradient(
                              colors: [Color(0xFFFFD700), Color(0xFFFFA000)],
                            ),
                            boxShadow: [
                              BoxShadow(
                                color:
                                    const Color(0xFFFFD700).withOpacity(0.35),
                                blurRadius: 20,
                                offset: const Offset(0, 8),
                              ),
                            ],
                          ),
                          child: ElevatedButton(
                            onPressed: () {
                              if (_currentPage == _contents.length - 1) {
                                _completeOnboarding();
                              } else {
                                _pageController.nextPage(
                                  duration: const Duration(milliseconds: 500),
                                  curve: Curves.easeOutCubic,
                                );
                              }
                            },
                            style: ElevatedButton.styleFrom(
                              backgroundColor: Colors.transparent,
                              shadowColor: Colors.transparent,
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(18),
                              ),
                            ),
                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Text(
                                  _currentPage == _contents.length - 1
                                      ? "Start Your Journey"
                                      : "Continue",
                                  style: const TextStyle(
                                    fontSize: 18,
                                    fontWeight: FontWeight.bold,
                                    color: Color(0xFF002366),
                                    letterSpacing: 0.5,
                                  ),
                                ),
                                if (_currentPage != _contents.length - 1) ...[
                                  const SizedBox(width: 8),
                                  const Icon(Icons.arrow_forward_rounded,
                                      color: Color(0xFF002366), size: 20),
                                ],
                              ],
                            ),
                          ),
                        ),
                      ),
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
}

// === DATA MODEL ===
class OnboardingContent {
  final String title;
  final String description;
  final IconData icon;
  final Color accentColor;

  OnboardingContent({
    required this.title,
    required this.description,
    required this.icon,
    required this.accentColor,
  });
}

// === INDIVIDUAL PAGE ===
class _OnboardingPage extends StatelessWidget {
  final OnboardingContent content;
  final Animation<double> fadeAnimation;

  const _OnboardingPage({
    required this.content,
    required this.fadeAnimation,
  });

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 36),
      child: FadeTransition(
        opacity: fadeAnimation,
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            // Hero Icon with glowing rings
            Stack(
              alignment: Alignment.center,
              children: [
                // Outer glow ring
                Container(
                  width: 200,
                  height: 200,
                  decoration: BoxDecoration(
                    shape: BoxShape.circle,
                    border: Border.all(
                      color: content.accentColor.withOpacity(0.1),
                      width: 1.5,
                    ),
                  ),
                ),
                // Middle ring
                Container(
                  width: 160,
                  height: 160,
                  decoration: BoxDecoration(
                    shape: BoxShape.circle,
                    border: Border.all(
                      color: content.accentColor.withOpacity(0.2),
                      width: 1.5,
                    ),
                  ),
                ),
                // Inner circle with icon
                Container(
                  width: 120,
                  height: 120,
                  decoration: BoxDecoration(
                    shape: BoxShape.circle,
                    gradient: LinearGradient(
                      begin: Alignment.topLeft,
                      end: Alignment.bottomRight,
                      colors: [
                        content.accentColor.withOpacity(0.2),
                        content.accentColor.withOpacity(0.05),
                      ],
                    ),
                    border: Border.all(
                      color: content.accentColor.withOpacity(0.3),
                      width: 2,
                    ),
                    boxShadow: [
                      BoxShadow(
                        color: content.accentColor.withOpacity(0.15),
                        blurRadius: 40,
                        spreadRadius: 10,
                      ),
                    ],
                  ),
                  child: Icon(
                    content.icon,
                    size: 56,
                    color: Colors.white,
                  ),
                ),
              ],
            ),
            const SizedBox(height: 56),

            // Gold accent line
            Container(
              width: 48,
              height: 3,
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  colors: [
                    content.accentColor.withOpacity(0.0),
                    content.accentColor,
                    content.accentColor.withOpacity(0.0),
                  ],
                ),
                borderRadius: BorderRadius.circular(2),
              ),
            ),
            const SizedBox(height: 28),

            // Title with gradient shader
            ShaderMask(
              shaderCallback: (bounds) => LinearGradient(
                colors: [
                  Colors.white,
                  content.accentColor.withOpacity(0.7),
                ],
                begin: Alignment.topCenter,
                end: Alignment.bottomCenter,
              ).createShader(bounds),
              child: Text(
                content.title,
                textAlign: TextAlign.center,
                style: const TextStyle(
                  fontSize: 34,
                  fontWeight: FontWeight.w900,
                  height: 1.1,
                  color: Colors.white,
                  fontFamily: 'Outfit',
                  letterSpacing: -0.5,
                ),
              ),
            ),
            const SizedBox(height: 20),

            // Description
            Text(
              content.description,
              textAlign: TextAlign.center,
              style: TextStyle(
                fontSize: 16,
                color: Colors.white.withOpacity(0.55),
                fontWeight: FontWeight.w400,
                height: 1.6,
              ),
            ),
          ],
        ),
      ),
    );
  }
}
