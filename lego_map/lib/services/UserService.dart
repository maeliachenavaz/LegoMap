import 'package:dio/dio.dart';
import '../models/user.dart';
import '../router/AuthRepository.dart';
import 'ApiClient.dart';

class UserService extends ApiClient {
  final AuthRepository _authRepo = AuthRepository();

  Future<Map<String, dynamic>> register(String name, String email, String password, {String role = 'user'}) async {
    try {
      final response = await dio.post('/register', data: {
        'name': name,
        'email': email,
        'password': password,
        'role': role,
      });
      return response.data;
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  Future<Map<String, dynamic>> login(String email, String password) async {
    try {
      final response = await dio.post('/login', data: {
        'email': email,
        'password': password,
      });
      return response.data as Map<String, dynamic>;
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  Future<void> logout(String userId) async {
    try {
      await dio.post('/logout', data: {'user_id': userId});
      await _authRepo.logout();
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  Future<User> getUser(String id) async {
    try {
      final response = await dio.get('/users/$id');
      return User.fromMap(response.data);
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  Future<User> updateUser(String id, Map<String, dynamic> data) async {
    try {
      final response = await dio.put('/users/$id', data: data);
      return User.fromMap(response.data);
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  Future<void> deleteUser(String id) async {
    try {
      await dio.delete('/users/$id');
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  String _handleError(DioException e) {
    if (e.response != null && e.response?.data is Map) {
      return e.response?.data['error']?.toString() ?? 'Erreur serveur';
    }
    return 'Erreur de connexion';
  }
}