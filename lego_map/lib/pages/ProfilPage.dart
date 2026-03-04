import 'package:flutter/material.dart';
import '../services/UserService.dart';
import '../router/AuthRepository.dart';
import '../models/user.dart';
import '../router/Router.dart';

class ProfilPage extends StatefulWidget {
  const ProfilPage({super.key});

  @override
  State<ProfilPage> createState() => _ProfilPageState();
}

class _ProfilPageState extends State<ProfilPage> {
  final UserService _userService = UserService();
  final AuthRepository _authRepo = AuthRepository();

  User? _user;
  bool _isLoading = true;
  bool _isEditing = false;
  final _formKey = GlobalKey<FormState>();

  late TextEditingController _nameController;
  late TextEditingController _emailController;

  // Palette LEGO
  final Color legoRed = const Color(0xFFD11013);
  final Color legoYellow = const Color(0xFFFACB16);
  final Color bgGray = const Color(0xFFF3F4F6);

  @override
  void initState() {
    super.initState();
    _loadUserProfile();
  }

  Future<void> _loadUserProfile() async {
    try {
      final userId = await _authRepo.getUserId();
      if (userId != null) {
        final user = await _userService.getUser(userId);
        setState(() {
          _user = user;
          _nameController = TextEditingController(text: user.name);
          _emailController = TextEditingController(text: user.email);
          _isLoading = false;
        });
      }
    } catch (e) {
      _showSnackBar("Erreur de chargement: $e", isError: true);
    }
  }

  void _toggleEdit() {
    setState(() {
      if (_isEditing) {
        _nameController.text = _user?.name ?? "";
        _emailController.text = _user?.email ?? "";
      }
      _isEditing = !_isEditing;
    });
  }

  Future<void> _updateProfile() async {
    if (!_formKey.currentState!.validate()) return;

    try {
      final updatedUser = await _userService.updateUser(_user!.id.toString(), {
        'name': _nameController.text,
        'email': _emailController.text,
      });
      setState(() {
        _user = updatedUser;
        _isEditing = false;
      });
      _showSnackBar("Profil mis à jour !");
    } catch (e) {
      _showSnackBar("Erreur: $e", isError: true);
    }
  }

  Future<void> _handleLogout() async {
    try {
      if (_user != null) {
        await _userService.logout(_user!.id.toString());
      } else {
        await _authRepo.logout();
      }

      AppRouter.router.go('/login');
      _showSnackBar("Déconnexion réussie ! À bientôt.");
    } catch (e) {
      await _authRepo.logout();
      AppRouter.router.go('/login');
    }
  }

  void _showSnackBar(String message, {bool isError = false}) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message, style: const TextStyle(fontWeight: FontWeight.bold, color: Colors.white)),
        backgroundColor: isError ? legoRed : Colors.green,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    if (_isLoading) return const Scaffold(body: Center(child: CircularProgressIndicator(color: Colors.red)));

    return Scaffold(
      backgroundColor: bgGray,
      appBar: AppBar(
        backgroundColor: legoYellow, // Retour au jaune ici
        elevation: 4,
        shadowColor: Colors.black.withOpacity(0.5),
        title: const Text(
          "LEGO Map",
          style: TextStyle(fontWeight: FontWeight.w900, color: Colors.black, letterSpacing: 1.5),
        ),
        actions: [
          IconButton(
            icon: Icon(_isEditing ? Icons.close : Icons.edit, color: Colors.black, size: 28),
            onPressed: _toggleEdit,
          ),
        ],
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20),
        child: Column(
          children: [
            const SizedBox(height: 10),
            // Avatar avec bordure noire épaisse
            Center(
              child: Container(
                width: 120,
                height: 120,
                decoration: BoxDecoration(
                  color: Colors.white,
                  shape: BoxShape.circle,
                  border: Border.all(color: Colors.black, width: 3),
                  boxShadow: [BoxShadow(color: legoYellow, offset: const Offset(4, 4))],
                ),
                child: Icon(Icons.person, size: 80, color: legoRed),
              ),
            ),
            const SizedBox(height: 30),

            // Card d'informations
            Container(
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(15),
                border: Border.all(color: Colors.black, width: 2),
                boxShadow: const [BoxShadow(color: Colors.black, offset: Offset(6, 6))],
              ),
              child: Form(
                key: _formKey,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    _buildInfoSection("NOM COMPLET", _nameController, Icons.face),
                    const Divider(height: 40, thickness: 2, color: Colors.black12),
                    _buildInfoSection("EMAIL DE CONTACT", _emailController, Icons.mail, isEmail: true),

                    if (_isEditing) ...[
                      const SizedBox(height: 30),
                      SizedBox(
                        width: double.infinity,
                        height: 55,
                        child: ElevatedButton(
                          style: ElevatedButton.styleFrom(
                            backgroundColor: legoRed, // Bouton d'action en rouge
                            foregroundColor: Colors.white,
                            side: const BorderSide(color: Colors.black, width: 2),
                            shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                            elevation: 5,
                          ),
                          onPressed: _updateProfile,
                          child: const Text("Enregistrer les modifications",
                              style: TextStyle(fontWeight: FontWeight.w900, fontSize: 16)),
                        ),
                      ),
                    ],
                  ],
                ),
              ),
            ),

            const SizedBox(height: 25),

            if (!_isEditing) ...[
              SizedBox(
                width: double.infinity,
                height: 50,
                child: OutlinedButton.icon(
                  style: OutlinedButton.styleFrom(
                    foregroundColor: Colors.black,
                    side: const BorderSide(color: Colors.black, width: 2),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                    backgroundColor: Colors.white,
                  ),
                  onPressed: _handleLogout,
                  icon: const Icon(Icons.logout),
                  label: const Text("SE DÉCONNECTER",
                      style: TextStyle(fontWeight: FontWeight.w900)),
                ),
              ),

              const SizedBox(height: 16),

              SizedBox(
                width: double.infinity,
                height: 50,
                child: OutlinedButton.icon(
                  style: OutlinedButton.styleFrom(
                    foregroundColor: legoRed,
                    side: BorderSide(color: legoRed, width: 2), // Bordure rouge LEGO
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                    backgroundColor: Colors.white,
                  ),
                  onPressed: () => _confirmDelete(context),
                  icon: const Icon(Icons.delete_forever),
                  label: const Text("SUPPRIMER LE COMPTE",
                      style: TextStyle(fontWeight: FontWeight.w900)),
                ),
              ),
            ],
          ],
        ),
      ),
    );
  }

  Widget _buildInfoSection(String label, TextEditingController controller, IconData icon, {bool isEmail = false}) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          children: [
            Icon(icon, size: 18, color: legoRed),
            const SizedBox(width: 8),
            Text(label, style: const TextStyle(color: Colors.black, fontWeight: FontWeight.w900, fontSize: 12)),
          ],
        ),
        const SizedBox(height: 8),
        _isEditing
            ? TextFormField(
          controller: controller,
          cursorColor: legoRed,
          style: const TextStyle(fontWeight: FontWeight.bold),
          decoration: InputDecoration(
            filled: true,
            fillColor: bgGray,
            border: OutlineInputBorder(borderRadius: BorderRadius.circular(8)),
            focusedBorder: OutlineInputBorder(borderSide: BorderSide(color: legoYellow, width: 2)),
          ),
          validator: (value) => value == null || value.isEmpty ? "Champ requis" : null,
        )
            : Padding(
          padding: const EdgeInsets.symmetric(vertical: 8.0),
          child: Text(
            controller.text,
            style: const TextStyle(fontSize: 18, fontWeight: FontWeight.w800, color: Colors.black87),
          ),
        ),
      ],
    );
  }

  Future<void> _confirmDelete(BuildContext context) async {
    final bool? confirm = await showDialog(
      context: context,
      builder: (context) => AlertDialog(
        backgroundColor: Colors.white,
        shape: const RoundedRectangleBorder(
          side: BorderSide(color: Colors.black, width: 3),
          borderRadius: BorderRadius.all(Radius.circular(15.0)),
        ),
        title: Text("SUPPRESSION ?", style: TextStyle(color: legoRed, fontWeight: FontWeight.w900)),
        content: const Text("Attention ! Tu es sur le point de supprimer ton compte définitivement."),
        actions: [
          TextButton(
              onPressed: () => Navigator.pop(context, false),
              child: const Text("ANNULER", style: TextStyle(color: Colors.black, fontWeight: FontWeight.bold))
          ),
          ElevatedButton(
            style: ElevatedButton.styleFrom(backgroundColor: legoRed),
            onPressed: () => Navigator.pop(context, true),
            child: const Text("SUPPRIMER", style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
          ),
        ],
      ),
    );

    if (confirm == true) {
      try {
        await _userService.deleteUser(_user!.id.toString());
        await _authRepo.logout();
        AppRouter.router.go('/login');
      } catch (e) {
        _showSnackBar(e.toString(), isError: true);
      }
    }
  }
}