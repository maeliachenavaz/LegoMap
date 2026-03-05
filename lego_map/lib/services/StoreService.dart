import 'package:dio/dio.dart';
import 'dart:convert';
import 'dart:io';
import '../models/Store.dart';
import 'ApiClient.dart';

class StoreService extends ApiClient {
  Future<List<Store>> getAllStores({int? page, int? limit}) async {
    try {
      final Map<String, dynamic> queryParams = {};

      if (page != null) queryParams['page'] = page;
      if (limit != null) queryParams['limit'] = limit;

      final response = await dio.get(
        '/stores',
        queryParameters: queryParams.isNotEmpty ? queryParams : null,
      );

      return (response.data as List).map((json) => Store.fromMap(json)).toList();
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  Future<List<Store>> getMyStores({int? page, int? limit}) async {
    try {
      final response = await dio.get(
        '/stores/user',
        queryParameters: {
          if (page != null) 'page': page,
          if (limit != null) 'limit': limit,
        },
      );
      return (response.data as List).map((json) => Store.fromMap(json)).toList();
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  Future<Store> createStore({
    required String nom,
    required String description,
    required String date,
    required int avis,
    required double latitude,
    required double longitude,
    required String contactNom,
    required String contactEmail,
    File? imageFile,
  }) async {
    try {
      String? base64Image;
      if (imageFile != null) {
        List<int> imageBytes = await imageFile.readAsBytes();
        base64Image = base64Encode(imageBytes);
      }

      final response = await dio.post(
        '/stores',
        data: {
          'nom': nom,
          'description': description,
          'date': date,
          'avis': avis,
          'latitude': latitude,
          'longitude': longitude,
          'contactNom': contactNom,
          'contactEmail': contactEmail,
          'photo': base64Image,
        },
      );

      return Store.fromMap(response.data);
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  Future<void> deleteStore(String id) async {
    try {
      await dio.delete('/stores/$id');
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  Future<Store> updateStore(String id, Map<String, dynamic> data) async {
    try {
      final response = await dio.put('/stores/$id', data: data);
      return Store.fromMap(response.data);
    } on DioException catch (e) {
      throw _handleError(e);
    }
  }

  String _handleError(DioException e) {
    if (e.response != null && e.response?.data is Map) {
      return e.response?.data['error'] ?? "Erreur serveur";
    }
    return "Erreur de connexion au serveur (${e.type})";
  }
}
