import 'package:dio/dio.dart';
import '../router/AuthRepository.dart';
import '../router/Router.dart';

class ApiClient {
  late Dio dio;
  final AuthRepository _authRepo = AuthRepository();

  ApiClient() {
    dio = Dio(BaseOptions(
      baseUrl: 'http://10.176.128.163:8001',
      contentType: 'application/json',
    ));

    dio.interceptors.add(InterceptorsWrapper(
      onRequest: (options, handler) async {
        final token = await _authRepo.getToken();
        if (token != null) {
          options.headers['Authorization'] = 'Bearer $token';
        }
        return handler.next(options);
      },
      onResponse: (response, handler) async {
        final newAccess = response.headers.value('X-New-Access-Token');
        final newRefresh = response.headers.value('X-New-Refresh-Token');

        if (newAccess != null) {
          final userId = await _authRepo.getUserId();
          await _authRepo.saveAuthData(
              newAccess,
              userId ?? '',
              refreshToken: newRefresh
          );
        }
        return handler.next(response);
      },
      onError: (DioException e, handler) async {
        if (e.response?.statusCode == 401) {
          String? refreshToken = await _authRepo.getRefreshToken();

          if (refreshToken != null) {
            try {
              final refreshDio = Dio(BaseOptions(baseUrl: dio.options.baseUrl));
              final response = await refreshDio.post('/refresh', data: {
                'refresh_token': refreshToken,
              });

              if (response.statusCode == 200) {
                final newToken = response.data['access_token'];
                final newRefresh = response.data['refresh_token'];
                final userId = response.data['user_id'];

                await _authRepo.saveAuthData(newToken, userId.toString(), refreshToken: newRefresh);

                e.requestOptions.headers['Authorization'] = 'Bearer $newToken';
                final opts = Options(
                  method: e.requestOptions.method,
                  headers: e.requestOptions.headers,
                );

                final clonedRequest = await dio.request(
                  e.requestOptions.path,
                  options: opts,
                  data: e.requestOptions.data,
                  queryParameters: e.requestOptions.queryParameters,
                );

                return handler.resolve(clonedRequest);
              }
            } catch (refreshError) {
              await _authRepo.logout();
              AppRouter.router.go('/login');
              return handler.next(e);
            }
          } else {
            await _authRepo.logout();
            AppRouter.router.go('/login');
          }
        }
        return handler.next(e);
      },
    ));
  }
}
