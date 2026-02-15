
class User {
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
    return User(
      id: json['id'].toString(),
      email: json['email'] as String,
      name: json['name'] as String,
      avatarUrl: json['avatar_url'] as String?,
      loyaltyPoints: json['loyalty_points'] ?? 0,
      tier: json['tier'] ?? 'bronze',
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
    return AuthResponse(
      user: User.fromJson(json['user']),
      token: json['token'] as String,
    );
  }
}
