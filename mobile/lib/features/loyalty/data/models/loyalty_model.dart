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
      points: json['points'],
      tier: json['tier'],
      nextTier: json['next_tier'],
      progressToNext: (json['progress_to_next'] as num).toDouble(),
      pointsNeeded: json['points_needed'],
    );
  }
}
