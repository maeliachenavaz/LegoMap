import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class AuthRepository {
  final _storage = const FlutterSecureStorage();

  static const _tokenKey = 'access_token';
  static const _refreshKey = 'refresh_token';
  static const _userIdKey = 'user_id';

  Future<void> saveAuthData(String token, String userId, {String? refreshToken}) async {
    await _storage.write(key: _tokenKey, value: token);
    await _storage.write(key: _userIdKey, value: userId);
    if (refreshToken != null) {
      await _storage.write(key: _refreshKey, value: refreshToken);
    }
  }

  Future<String?> getToken() async {
    return await _storage.read(key: _tokenKey);
  }

  Future<String?> getRefreshToken() async {
    return await _storage.read(key: _refreshKey);
  }

  Future<String?> getUserId() async {
    return await _storage.read(key: _userIdKey);
  }

  Future<bool> isAuthenticated() async {
    String? token = await _storage.read(key: _tokenKey);
    return token != null;
  }

  Future<void> logout() async {
    await _storage.deleteAll();
  }
}