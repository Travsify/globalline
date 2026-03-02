
class User {
  final String id;
  final String name;
  final String email;
  final String? avatarUrl;
  final int loyaltyPoints;
  final String tier;

  User({
    required this.id,
    required this.email,
    required this.name,
    this.avatarUrl,
    this.loyaltyPoints = 0,
    this.tier = 'bronze',
  });

  factory User.fromJson(Map<String, dynamic> json) {
    // Defensive check for fields that might be strings but expected as ints
    int parsePoints(dynamic points) {
      if (points == null) return 0;
      if (points is int) return points;
      if (points is String) return int.tryParse(points) ?? 0;
      return 0;
    }

    return User(
      id: json['id']?.toString() ?? '',
      email: json['email']?.toString() ?? '',
      name: json['name']?.toString() ?? '',
      avatarUrl: json['avatar_url']?.toString(),
      loyaltyPoints: parsePoints(json['loyalty_points']),
      tier: json['tier']?.toString() ?? 'bronze',
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'email': email,
      'name': name,
      'avatar_url': avatarUrl,
      'loyalty_points': loyaltyPoints,
      'tier': tier,
    };
  }
}

class AuthResponse {
  final User user;
  final String token;

  AuthResponse({required this.user, required this.token});

  factory AuthResponse.fromJson(Map<String, dynamic> json) {
    final userData = json['user'];
    
    // Defensive check: handle if 'user' is a List instead of a Map
    Map<String, dynamic> userMap;
    if (userData is Map<String, dynamic>) {
      userMap = userData;
    } else if (userData is List && userData.isNotEmpty && userData.first is Map<String, dynamic>) {
      userMap = userData.first as Map<String, dynamic>;
    } else {
      // Fallback if user is missing or in unexpected format
      userMap = {};
    }

    return AuthResponse(
      user: User.fromJson(userMap),
      token: (json['token'] as String?) ?? '',
    );
  }
}
