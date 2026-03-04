import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import '../layouts/MainLayout.dart';
import '../models/Store.dart';
import '../pages/CreateStorePage.dart';
import '../pages/HomePage.dart';
import '../pages/LoginPage.dart';
import '../pages/PersonnalPage.dart';
import '../pages/ProfilPage.dart';
import '../pages/RegisterPage.dart';
import '../pages/StoreDetailPage.dart';
import '../pages/StoreManagePage.dart';
import 'AuthRepository.dart';

class AppRouter {
  static final AuthRepository _authRepo = AuthRepository();

  static final router = GoRouter(
    initialLocation: '/',

    redirect: (BuildContext context, GoRouterState state) async {
      final bool loggedIn = await _authRepo.isAuthenticated();
      final bool isLoggingIn = state.uri.path == '/login' || state.uri.path == '/register';

      if (!loggedIn && !isLoggingIn) {
        return '/login';
      }

      if (loggedIn && isLoggingIn) {
        return '/';
      }

      return null;
    },

    routes: [
      GoRoute(
        path: '/login',
        builder: (context, state) => const LoginPage(),
      ),
      GoRoute(
        path: '/register',
        builder: (context, state) => const RegisterPage(),
      ),

      ShellRoute(
        builder: (context, state, child) {
          return MainLayout(
            currentLocation: state.uri.path,
            child: child,
          );
        },
        routes: [
          GoRoute(
            path: '/',
            builder: (context, state) => const HomePage(),
            routes: [
              GoRoute(
                path: 'store/:id',
                builder: (context, state) {
                  final store = state.extra as Store;
                  return StoreDetailPage(store: store);
                },
              ),
            ],),
          GoRoute(
              path: '/personnal',
              builder: (context, state) => const PersonnalPage(),
            routes: [
              GoRoute(
                path: 'create',
                builder: (context, state) => const CreateStorePage(),
              ),
              GoRoute(
                path: 'manage/:id',
                builder: (context, state) {
                  final store = state.extra as Store;
                  return StoreManagePage(store: store);
                },
              ),
            ],
          ),
          GoRoute(path: '/profil', builder: (context, state) => const ProfilPage()),
        ],
      ),
    ],
  );
}