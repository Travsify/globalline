import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class AppTheme {
  static final lightTheme = ThemeData(
    useMaterial3: true,
    colorScheme: ColorScheme.fromSeed(
      seedColor: const Color(0xFF002366), // Royal Blue
      primary: const Color(0xFF002366),
      secondary: const Color(0xFFFFD700), // Gold
      tertiary: const Color(0xFFFFD700),
      brightness: Brightness.light,
    ),
    scaffoldBackgroundColor: Colors.white,
    appBarTheme: const AppBarTheme(
      backgroundColor: Colors.white,
      foregroundColor: Color(0xFF002366),
      elevation: 0,
    ),
    filledButtonTheme: FilledButtonThemeData(
      style: FilledButton.styleFrom(
        backgroundColor: const Color(0xFF002366),
        foregroundColor: Colors.white, // Gold text on Blue button? Or White. White is better contrast.
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      ),
    ),
    textTheme: GoogleFonts.outfitTextTheme(), // More premium font
  );

  static final darkTheme = ThemeData(
    useMaterial3: true,
    colorScheme: ColorScheme.fromSeed(
      seedColor: const Color(0xFF002366),
      primary: const Color(0xFF4169E1), // Lighter Royal Blue for Dark Mode
      secondary: const Color(0xFFFFD700),
      tertiary: const Color(0xFFFFD700),
      brightness: Brightness.dark,
    ),
    textTheme: GoogleFonts.outfitTextTheme(ThemeData.dark().textTheme),
  );
}
