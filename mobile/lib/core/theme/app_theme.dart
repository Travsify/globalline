import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class AppTheme {
  static final lightTheme = ThemeData(
    useMaterial3: true,
    colorScheme: ColorScheme.fromSeed(
      seedColor: const Color(0xFF002366),
      primary: const Color(0xFF002366),
      secondary: const Color(0xFFFFD700),
      background: const Color(0xFFF8FAFC),
      brightness: Brightness.light,
    ),
    scaffoldBackgroundColor: const Color(0xFFF8FAFC),
    appBarTheme: const AppBarTheme(
      backgroundColor: Colors.white,
      foregroundColor: Color(0xFF002366),
      elevation: 0,
      centerTitle: true,
    ),
    filledButtonTheme: FilledButtonThemeData(
      style: FilledButton.styleFrom(
        backgroundColor: const Color(0xFF002366),
        foregroundColor: Colors.white,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        padding: const EdgeInsets.symmetric(vertical: 16, horizontal: 24),
      ),
    ),
    cardTheme: CardThemeData(
      elevation: 0,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(24), side: const BorderSide(color: Color(0xFFF1F5F9))),
      color: Colors.white,
    ),
    textTheme: GoogleFonts.outfitTextTheme(),
  );

  static final darkTheme = ThemeData(
    useMaterial3: true,
    colorScheme: ColorScheme.fromSeed(
      seedColor: const Color(0xFF002366),
      primary: const Color(0xFF3B82F6), // Vibrant blue for dark mode
      secondary: const Color(0xFFFFD700),
      background: const Color(0xFF020617), // Rich slate-950
      surface: const Color(0xFF0F172A), // Slate-900
      brightness: Brightness.dark,
    ),
    scaffoldBackgroundColor: const Color(0xFF020617),
    appBarTheme: const AppBarTheme(
      backgroundColor: Color(0xFF020617),
      foregroundColor: Colors.white,
      elevation: 0,
      centerTitle: true,
    ),
    cardTheme: CardThemeData(
      elevation: 0,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(24), side: const BorderSide(color: Color(0xFF1E293B))),
      color: const Color(0xFF0F172A),
    ),
    textTheme: GoogleFonts.outfitTextTheme(ThemeData.dark().textTheme),
  );

  static BoxDecoration premiumCardDecoration(BuildContext context) {
    bool isDark = Theme.of(context).brightness == Brightness.dark;
    return BoxDecoration(
      color: isDark ? const Color(0xFF1E293B) : Colors.white,
      borderRadius: BorderRadius.circular(24),
      border: Border.all(color: isDark ? const Color(0xFF334155) : const Color(0xFFF1F5F9)),
      boxShadow: [
        BoxShadow(
          color: isDark ? Colors.black.withOpacity(0.5) : const Color(0xFF64748B).withOpacity(0.05),
          blurRadius: 20,
          offset: const Offset(0, 10),
        )
      ],
    );
  }
}
