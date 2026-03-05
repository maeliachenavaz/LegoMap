import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:latlong2/latlong.dart';
import 'package:geolocator/geolocator.dart';
import 'package:image_picker/image_picker.dart';
import 'dart:io';
import '../services/StoreService.dart';

class CreateStorePage extends StatefulWidget {
  const CreateStorePage({super.key});

  @override
  State<CreateStorePage> createState() => _CreateStorePageState();
}

class _CreateStorePageState extends State<CreateStorePage> {
  final _formKey = GlobalKey<FormState>();
  final StoreService _storeService = StoreService();
  final ImagePicker _picker = ImagePicker();

  final TextEditingController _nomController = TextEditingController();
  final TextEditingController _descController = TextEditingController();
  final TextEditingController _contactNomController = TextEditingController();
  final TextEditingController _contactEmailController = TextEditingController();

  LatLng? _pickedLocation;
  File? _selectedImage;
  bool _isLoading = false;

  final Color legoRed = const Color(0xFFD11013);
  final Color legoYellow = const Color(0xFFFACB16);

  Future<void> _pickImage(ImageSource source) async {
    try {
      final XFile? pickedFile = await _picker.pickImage(
        source: source,
        imageQuality: 70,
      );
      if (pickedFile != null) {
        setState(() {
          _selectedImage = File(pickedFile.path);
        });
      }
    } catch (e) {
      _showSnackBar("Erreur lors de la sélection de l'image", legoRed);
    }
  }

  void _showImageSourceActionSheet(BuildContext context) {
    showModalBottomSheet(
      context: context,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(top: Radius.circular(20)),
      ),
      builder: (context) => SafeArea(
        child: Wrap(
          children: [
            ListTile(
              leading: const Icon(Icons.camera_alt),
              title: const Text('Prendre une photo'),
              onTap: () {
                Navigator.pop(context);
                _pickImage(ImageSource.camera);
              },
            ),
            ListTile(
              leading: const Icon(Icons.photo_library),
              title: const Text('Choisir depuis la galerie'),
              onTap: () {
                Navigator.pop(context);
                _pickImage(ImageSource.gallery);
              },
            ),
          ],
        ),
      ),
    );
  }

  Future<void> _getLocation() async {
    setState(() => _isLoading = true);
    try {
      LocationPermission permission = await Geolocator.checkPermission();
      if (permission == LocationPermission.denied) {
        permission = await Geolocator.requestPermission();
      }

      Position position = await Geolocator.getCurrentPosition();
      setState(() {
        _pickedLocation = LatLng(position.latitude, position.longitude);
        _isLoading = false;
      });
      _showSnackBar("Position GPS capturée ! 📍", Colors.green);
    } catch (e) {
      setState(() => _isLoading = false);
      _showSnackBar("Erreur GPS : Vérifiez vos réglages", legoRed);
    }
  }

  Future<void> _submit() async {
    if (!_formKey.currentState!.validate()) return;
    if (_pickedLocation == null) {
      _showSnackBar("Veuillez capturer votre position GPS", legoRed);
      return;
    }

    setState(() => _isLoading = true);
    try {
      await _storeService.createStore(
        nom: _nomController.text,
        description: _descController.text,
        date: DateTime.now().toIso8601String(),
        avis: 5,
        latitude: _pickedLocation!.latitude,
        longitude: _pickedLocation!.longitude,
        contactNom: _contactNomController.text,
        contactEmail: _contactEmailController.text,
        imageFile: _selectedImage,
      );

      if (mounted) {
        context.pop();
      }
    } catch (e) {
      setState(() => _isLoading = false);
      _showSnackBar("Erreur: $e", legoRed);
    }
  }

  void _showSnackBar(String message, Color color) {
    ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text(message), backgroundColor: color)
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF3F4F6),
      appBar: AppBar(
        backgroundColor: legoYellow,
        title: const Text("NOUVEAU STORE", style: TextStyle(fontWeight: FontWeight.w900)),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20),
        child: Form(
          key: _formKey,
          child: Column(
            children: [
              // --- ZONE IMAGE ---
              GestureDetector(
                onTap: () => _showImageSourceActionSheet(context),
                child: Container(
                  height: 180,
                  width: double.infinity,
                  decoration: BoxDecoration(
                    color: Colors.white,
                    border: Border.all(color: Colors.black, width: 3),
                    borderRadius: BorderRadius.circular(15),
                    boxShadow: const [BoxShadow(color: Colors.black, offset: Offset(4, 4))],
                  ),
                  child: _selectedImage != null
                      ? ClipRRect(
                    borderRadius: BorderRadius.circular(12),
                    child: Image.file(_selectedImage!, fit: BoxFit.cover),
                  )
                      : Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: const [
                      Icon(Icons.add_a_photo, size: 50, color: Colors.grey),
                      SizedBox(height: 10),
                      Text("AJOUTER UNE PHOTO", style: TextStyle(fontWeight: FontWeight.w900, color: Colors.grey)),
                    ],
                  ),
                ),
              ),
              const SizedBox(height: 25),

              _buildInput("NOM DU STORE", _nomController, Icons.store),
              _buildInput("DESCRIPTION", _descController, Icons.description, maxLines: 3),
              _buildInput("NOM DU CONTACT", _contactNomController, Icons.person),
              _buildInput("EMAIL DE CONTACT", _contactEmailController, Icons.email),

              const SizedBox(height: 20),

              GestureDetector(
                onTap: _getLocation,
                child: Container(
                  width: double.infinity,
                  padding: const EdgeInsets.all(20),
                  decoration: BoxDecoration(
                    color: _pickedLocation == null ? Colors.white : Colors.green[50],
                    border: Border.all(color: Colors.black, width: 2),
                    borderRadius: BorderRadius.circular(15),
                    boxShadow: const [BoxShadow(color: Colors.black, offset: Offset(4, 4))],
                  ),
                  child: Column(
                    children: [
                      Icon(_pickedLocation == null ? Icons.location_on : Icons.check_circle,
                          size: 40, color: _pickedLocation == null ? legoRed : Colors.green),
                      const SizedBox(height: 10),
                      Text(
                        _pickedLocation == null ? "CAPTURER MA POSITION GPS" : "POSITION ENREGISTRÉE",
                        style: const TextStyle(fontWeight: FontWeight.w900),
                      )
                    ],
                  ),
                ),
              ),

              const SizedBox(height: 30),

              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                      backgroundColor: legoRed,
                      padding: const EdgeInsets.symmetric(vertical: 15),
                      side: const BorderSide(color: Colors.black, width: 2),
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10))
                  ),
                  onPressed: _isLoading ? null : _submit,
                  child: _isLoading
                      ? const CircularProgressIndicator(color: Colors.white)
                      : const Text("PUBLIER LE STORE", style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 16)),
                ),
              ),
              const SizedBox(height: 20),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildInput(String label, TextEditingController controller, IconData icon, {int maxLines = 1}) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 20),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(label, style: const TextStyle(fontWeight: FontWeight.w900, fontSize: 13)),
          const SizedBox(height: 8),
          TextFormField(
            controller: controller,
            maxLines: maxLines,
            decoration: InputDecoration(
              prefixIcon: Icon(icon, color: Colors.black),
              filled: true,
              fillColor: Colors.white,
              enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(12), borderSide: const BorderSide(color: Colors.black, width: 2)),
              focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(12), borderSide: BorderSide(color: legoYellow, width: 3)),
            ),
            validator: (v) => v!.isEmpty ? "Champ obligatoire" : null,
          ),
        ],
      ),
    );
  }
}
