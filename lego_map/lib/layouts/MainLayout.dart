import 'package:flutter/material.dart';
import '../widgets/BottomNavBar.dart';

class MainLayout extends StatelessWidget {
  final Widget child;
  final String currentLocation;

  const MainLayout({
    super.key,
    required this.child,
    required this.currentLocation,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: child,
      bottomNavigationBar: BottomNavBar(currentLocation: currentLocation),
    );
  }
}
