class LoyaltyStats {
  final int points;
  final String tier;
  final String? nextTier;
  final double progressToNext;
  final int pointsNeeded;

  LoyaltyStats({
    required this.points,
    required this.tier,
    this.nextTier,
    required this.progressToNext,
    required this.pointsNeeded,
  });

  factory LoyaltyStats.fromJson(Map<String, dynamic> json) {
    return LoyaltyStats(
      points: (json['points'] as num?)?.toInt() ?? 0,
      tier: json['tier']?.toString() ?? 'bronze',
      nextTier: json['next_tier']?.toString(),
      progressToNext: (json['progress_to_next'] as num?)?.toDouble() ?? 0.0,
      pointsNeeded: (json['points_needed'] as num?)?.toInt() ?? 0,
    );
  }
}
