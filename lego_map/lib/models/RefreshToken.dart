import 'dart:convert';

class RefreshToken {
  String? id;
  String userId;
  String tokenHash;
  String jti;
  String expiresAt;
  String? createdAt;
  String? updatedAt;

  RefreshToken({
    this.id,
    required this.userId,
    required this.tokenHash,
    required this.jti,
    required this.expiresAt,
    this.createdAt,
    this.updatedAt,
  });

  Map<String, dynamic> toMap() {
    return {
      'id': id,
      'user_id': userId,
      'token_hash': tokenHash,
      'jti': jti,
      'expires_at': expiresAt,
      'created_at': createdAt,
      'updated_at': updatedAt,
    };
  }

  String toJson() => json.encode(toMap());

  factory RefreshToken.fromMap(Map<String, dynamic> map) {
    return RefreshToken(
      id: map['id'],
      userId: map['user_id'] ?? '',
      tokenHash: map['token_hash'] ?? '',
      jti: map['jti'] ?? '',
      expiresAt: map['expires_at'] ?? '',
      createdAt: map['created_at'],
      updatedAt: map['updated_at'],
    );
  }

  factory RefreshToken.fromJson(String source) =>
      RefreshToken.fromMap(json.decode(source));
}
