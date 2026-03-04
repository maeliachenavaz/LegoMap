import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';

class BottomNavBar extends StatelessWidget {
  final String currentLocation;

  const BottomNavBar({super.key, required this.currentLocation});

  void _onItemTapped(BuildContext context, int index) {
    switch (index) {
      case 0:
        context.go('/');
        break;
      case 1:
        context.go('/personnal');
        break;
      case 2:
        context.go('/profil');
        break;
    }
  }

  @override
  Widget build(BuildContext context) {
    final currentIndex = _calculateIndex();

    return BottomNavigationBar(
      currentIndex: currentIndex,
      onTap: (index) => _onItemTapped(context, index),
      selectedItemColor: const Color(0xFFFACB16),
      unselectedItemColor: Colors.white,
      backgroundColor: Colors.black,
      type: BottomNavigationBarType.fixed,
      items: const [
        BottomNavigationBarItem(
          icon: Padding(
            padding: EdgeInsets.only(top: 8.0),
            child: Icon(Icons.map),
          ),
          label: 'Accueil',
        ),
        BottomNavigationBarItem(
          icon: Padding(
            padding: EdgeInsets.only(top: 8.0),
            child: Icon(Icons.storefront),
          ),
          label: 'Mes Stores',
        ),
        BottomNavigationBarItem(
          icon: Padding(
            padding: EdgeInsets.only(top: 8.0),
            child: Icon(Icons.person_outline),
          ),
          label: 'Profil',
        ),
      ],
    );
  }

  int _calculateIndex() {
    if (currentLocation.startsWith('/personnal')) return 1;
    if (currentLocation.startsWith('/profil')) return 2;

    return 0;
  }
}