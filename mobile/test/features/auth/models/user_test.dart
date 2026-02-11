
import 'package:flutter_test/flutter_test.dart';
import 'package:mobile/features/auth/data/models/auth_models.dart';

void main() {
  group('User Model', () {
    test('should parse User from JSON correctly', () {
      final json = {
        'id': '123',
        'email': 'test@example.com',
        'name': 'Test User',
        'avatar_url': 'https://example.com/avatar.png',
      };

      final user = User.fromJson(json);

      expect(user.id, '123');
      expect(user.email, 'test@example.com');
      expect(user.name, 'Test User');
      expect(user.avatarUrl, 'https://example.com/avatar.png');
    });

    test('should handle null avatar_url', () {
      final json = {
        'id': '123',
        'email': 'test@example.com',
        'name': 'Test User',
        'avatar_url': null,
      };

      final user = User.fromJson(json);

      expect(user.avatarUrl, isNull);
    });

    test('should convert User to JSON correctly', () {
      final user = User(
        id: '123',
        email: 'test@example.com',
        name: 'Test User',
        avatarUrl: 'https://example.com/avatar.png',
      );

      final json = user.toJson();

      expect(json['id'], '123');
      expect(json['email'], 'test@example.com');
      expect(json['name'], 'Test User');
      expect(json['avatar_url'], 'https://example.com/avatar.png');
    });
  });
}
