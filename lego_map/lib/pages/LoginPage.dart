import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import '../router/AuthRepository.dart';
import '../services/UserService.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _formKey = GlobalKey<FormState>();
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();

  final UserService _userService = UserService();
  final AuthRepository _authRepo = AuthRepository();

  // COULEURS LEGO AJUSTÉES
  final Color legoRed = const Color(0xFFB91C1C);   // Rouge plus vif (red-700)
  final Color legoYellow = const Color(0xFFFACB16); // Jaune LEGO officiel
  final Color bgGray = const Color(0xFFF3F4F6);    // gray-100 du site

  bool _isLoading = false;
  bool _obscurePassword = true;
  String? _errorMessage;

  Future<void> _handleLogin() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() => _isLoading = true);
    try {
      final Map<String, dynamic> response = await _userService.login(
        _emailController.text.trim(),
        _passwordController.text,
      );

      await _authRepo.saveAuthData(
        response['access_token'].toString(),
        response['user_id'].toString(),
      );

      if (mounted) context.go('/');
    } catch (e) {
      setState(() => _errorMessage = e.toString());
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: legoYellow, // Fond Jaune LEGO pour un impact max au login
      body: Center(
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(24.0),
          child: Column(
            children: [
              // Logo : Épingle de localisation sur une brique
              Container(
                padding: const EdgeInsets.all(15),
                decoration: const BoxDecoration(
                  color: Colors.white,
                  shape: BoxShape.circle,
                ),
                child: Icon(Icons.location_on, size: 60, color: legoRed),
              ),
              const SizedBox(height: 12),
              const Text(
                "LEGO MAP",
                style: TextStyle(
                  color: Colors.black,
                  fontSize: 36,
                  letterSpacing: -1,
                ),
              ),
              const SizedBox(height: 30),

              // Carte du formulaire (Style Site Web)
              Container(
                padding: const EdgeInsets.all(24),
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(25),
                  border: Border.all(color: Colors.black, width: 3), // Style "contour" brique
                  boxShadow: const [
                    BoxShadow(color: Colors.black, offset: Offset(6, 6))
                  ],
                ),
                child: Form(
                  key: _formKey,
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Center(
                        child: Text(
                          "CONNEXION",
                          style: TextStyle(
                              fontSize: 22,
                              color: legoRed
                          ),
                        ),
                      ),
                      const SizedBox(height: 24),

                      const Text("Email", style: TextStyle(fontWeight: FontWeight.bold)),
                      const SizedBox(height: 8),
                      TextFormField(
                        controller: _emailController,
                        decoration: _inputDecoration("votre@email.com", Icons.email_outlined),
                        validator: (value) => (value == null || !value.contains('@')) ? "Email invalide" : null,
                      ),

                      const SizedBox(height: 20),

                      const Text("Mot de passe", style: TextStyle(fontWeight: FontWeight.bold)),
                      const SizedBox(height: 8),
                      TextFormField(
                        controller: _passwordController,
                        obscureText: _obscurePassword, // Utilisation de la variable
                        decoration: _inputDecoration(
                          "••••••••",
                          Icons.lock_outline,
                          suffixIcon: IconButton(
                            icon: Icon(
                              _obscurePassword ? Icons.visibility_off : Icons.visibility,
                              color: Colors.black,
                            ),
                            onPressed: () {
                              setState(() {
                                _obscurePassword = !_obscurePassword;
                              });
                            },
                          ),
                        ),
                      ),

                      if (_errorMessage != null) ...[
                        const SizedBox(height: 16),
                        Text(_errorMessage!, style: const TextStyle(color: Colors.red, fontWeight: FontWeight.bold)),
                      ],
                      const SizedBox(height: 32),

                      // Bouton Rouge (bg-red-800) avec ombre noire
                      SizedBox(
                        width: double.infinity,
                        height: 55,
                        child: ElevatedButton(
                          onPressed: _isLoading ? null : _handleLogin,
                          style: ElevatedButton.styleFrom(
                            backgroundColor: legoRed,
                            foregroundColor: Colors.white,
                            elevation: 0,
                            shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(12),
                                side: const BorderSide(color: Colors.black, width: 2)
                            ),
                          ),
                          child: _isLoading
                              ? const CircularProgressIndicator(color: Colors.white)
                              : const Text("C'EST PARTI !", style: TextStyle(fontSize: 18)),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
              const SizedBox(height: 32),

              // Lien Register
              TextButton(
                onPressed: () => context.push('/register'),
                child: const Text(
                  "Pas encore de compte ? Créer un compte",
                  style: TextStyle(
                    color: Colors.black,
                    fontWeight: FontWeight.bold,
                    decoration: TextDecoration.underline,
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  InputDecoration _inputDecoration(String hint, IconData icon, {Widget? suffixIcon}) {
    return InputDecoration(
      hintText: hint,
      prefixIcon: Icon(icon, color: Colors.black),
      suffixIcon: suffixIcon, // Ajout du bouton ici
      filled: true,
      fillColor: bgGray,
      border: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: const BorderSide(color: Colors.black, width: 2),
      ),
      enabledBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: const BorderSide(color: Colors.black, width: 2),
      ),
      focusedBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: BorderSide(color: legoRed, width: 3),
      ),
    );
  }
}