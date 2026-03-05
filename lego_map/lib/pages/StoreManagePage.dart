import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:flutter_map/flutter_map.dart';
import 'package:go_router/go_router.dart';
import 'package:latlong2/latlong.dart';
import 'package:geolocator/geolocator.dart';
import '../models/Store.dart';
import '../services/StoreService.dart';

class StoreManagePage extends StatefulWidget {
  final Store store;
  const StoreManagePage({super.key, required this.store});

  @override
  State<StoreManagePage> createState() => _StoreManagePageState();
}

class _StoreManagePageState extends State<StoreManagePage> {
  final StoreService _storeService = StoreService();
  final MapController _mapController = MapController();

  bool _isEditing = false;
  late Store _currentStore;
  late TextEditingController _nomController;
  late TextEditingController _descController;
  late TextEditingController _contactNomController;
  late TextEditingController _contactEmailController;
  late LatLng _currentLocation;

  final Color legoRed = const Color(0xFFD11013);
  final Color legoYellow = const Color(0xFFFACB16);
  final Color bgGray = const Color(0xFFF3F4F6);

  @override
  void initState() {
    super.initState();
    _currentStore = widget.store;
    _currentLocation = LatLng(_currentStore.latitude, _currentStore.longitude);
    _nomController = TextEditingController(text: _currentStore.nom);
    _descController = TextEditingController(text: _currentStore.description);
    _contactNomController = TextEditingController(text: _currentStore.contactNom);
    _contactEmailController = TextEditingController(text: _currentStore.contactEmail);
  }

  Future<void> _deleteStore() async {
    final confirm = await showDialog<bool>(
      context: context,
      builder: (ctx) => AlertDialog(
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(15),
          side: const BorderSide(color: Colors.black, width: 3),
        ),
        title: const Text("SUPPRIMER LE STORE ?", style: TextStyle(fontWeight: FontWeight.w900)),
        content: const Text("Attention, toutes les informations seront perdues définitivement !"),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(ctx, false),
            child: const Text("ANNULER", style: TextStyle(color: Colors.black, fontWeight: FontWeight.bold)),
          ),
          ElevatedButton(
            style: ElevatedButton.styleFrom(backgroundColor: legoRed),
            onPressed: () => Navigator.pop(ctx, true),
            child: const Text("SUPPRIMER", style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
          ),
        ],
      ),
    );

    if (confirm == true) {
      try {
        await _storeService.deleteStore(_currentStore.id.toString());

        if (mounted) {
          context.pop();
        }
      } catch (e) {
        _showSnackBar("Erreur lors de la suppression.", legoRed);
      }
    }
  }

  Future<void> _getCurrentPosition() async {
    _showSnackBar("Recherche du signal GPS... 📡", legoYellow);
    try {
      Position position = await Geolocator.getCurrentPosition(
        locationSettings: const LocationSettings(
          accuracy: LocationAccuracy.high,
          timeLimit: Duration(seconds: 10),
        ),
      );

      final newLatLng = LatLng(position.latitude, position.longitude);
      setState(() {
        _currentLocation = newLatLng;
      });
      _mapController.move(newLatLng, 15.0);
      _showSnackBar("Position mise à jour ! 📍", Colors.green);
    } catch (e) {
      _showSnackBar("Erreur : Signal GPS introuvable.", legoRed);
    }
  }

  Future<void> _handlePermissionAndGPS() async {
    bool serviceEnabled = await Geolocator.isLocationServiceEnabled();
    if (!serviceEnabled) {
      _showSnackBar("Activez le GPS du téléphone.", legoRed);
      await Geolocator.openLocationSettings();
      return;
    }

    LocationPermission permission = await Geolocator.checkPermission();
    if (permission == LocationPermission.denied) {
      permission = await Geolocator.requestPermission();
      if (permission == LocationPermission.denied) {
        _showSnackBar("Permission refusée.", legoRed);
        return;
      }
    }

    if (permission == LocationPermission.deniedForever) {
      _showSnackBar("Permission bloquée dans les réglages.", legoRed);
      await Geolocator.openAppSettings();
      return;
    }

    _getCurrentPosition();
  }

  Future<void> _updateStore() async {
    try {
      final updated = await _storeService.updateStore(_currentStore.id.toString(), {
        'nom': _nomController.text,
        'description': _descController.text,
        'contactNom': _contactNomController.text,
        'contactEmail': _contactEmailController.text,
        'latitude': _currentLocation.latitude,
        'longitude': _currentLocation.longitude,
      });
      setState(() {
        _currentStore = updated;
        _isEditing = false;
      });
      _showSnackBar("Store mis à jour avec succès !", Colors.green);
    } catch (e) {
      _showSnackBar("Erreur lors de la mise à jour.", legoRed);
    }
  }

  void _showSnackBar(String message, Color color) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(message, style: const TextStyle(fontWeight: FontWeight.bold)), backgroundColor: color, behavior: SnackBarBehavior.floating),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: bgGray,
      appBar: AppBar(
        backgroundColor: legoYellow,
        title: Text(_isEditing ? "MODIFIER" : "LEGO Map", style: const TextStyle(fontWeight: FontWeight.w900)),
        actions: [
          IconButton(
            icon: Icon(_isEditing ? Icons.close : Icons.edit),
            onPressed: () => setState(() => _isEditing = !_isEditing),
          ),
        ],
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            _buildImageHeader(),
            const SizedBox(height: 25),
            const Text("LOCALISATION", style: TextStyle(fontWeight: FontWeight.w900, fontSize: 18)),
            const SizedBox(height: 12),
            _buildMapSection(),
            const SizedBox(height: 30),
            _buildField("NOM", _nomController),
            _buildField("DESCRIPTION", _descController, maxLines: 3),
            _buildField("CONTACT", _contactNomController),
            _buildField("EMAIL", _contactEmailController),
            const SizedBox(height: 30),

            if (_isEditing)
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(backgroundColor: Colors.green[700], padding: const EdgeInsets.symmetric(vertical: 15)),
                  onPressed: _updateStore,
                  child: const Text("SAUVEGARDER", style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                ),
              )
            else
              Center(
                child: TextButton.icon(
                  onPressed: _deleteStore,
                  icon: Icon(Icons.delete_forever, color: legoRed),
                  label: Text(
                    "SUPPRIMER CE STORE",
                    style: TextStyle(
                        color: legoRed,
                        fontWeight: FontWeight.w900,
                        decoration: TextDecoration.underline
                    ),
                  ),
                ),
              ),
            const SizedBox(height: 40),
          ],
        ),
      ),
    );
  }

  Widget _buildImageHeader() {
    return Container(
      height: 180,
      width: double.infinity,
      decoration: BoxDecoration(color: Colors.white, border: Border.all(color: Colors.black, width: 3), borderRadius: BorderRadius.circular(15)),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(12),
        child: Image.memory(base64Decode(_currentStore.photo.split(',').last), fit: BoxFit.cover)
      ),
    );
  }

  Widget _buildMapSection() {
    return Column(
      children: [
        Container(
          height: 200,
          decoration: BoxDecoration(
              border: Border.all(color: Colors.black, width: 3),
              borderRadius: BorderRadius.circular(15)
          ),
          child: ClipRRect(
            borderRadius: BorderRadius.circular(12),
            child: FlutterMap(
              mapController: _mapController,
              options: MapOptions(
                initialCenter: _currentLocation,
                initialZoom: 15.0,
                onTap: _isEditing ? (p, latlng) => setState(() => _currentLocation = latlng) : null,
              ),
              children: [
                TileLayer(
                  urlTemplate: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                  additionalOptions: const {
                    'User-Agent': 'com.legomap.cesi',
                  },
                  userAgentPackageName: 'com.cesi.legomap',
                ),
                MarkerLayer(
                  markers: [
                    Marker(
                        point: _currentLocation,
                        width: 50,
                        height: 50,
                        child: Icon(Icons.location_on, color: legoRed, size: 40)
                    )
                  ],
                ),
              ],
            ),
          ),
        ),
        if (_isEditing)
          Padding(
            padding: const EdgeInsets.all(10),
            child: OutlinedButton.icon(
              onPressed: _handlePermissionAndGPS,
              icon: const Icon(Icons.my_location),
              label: const Text("ACTUALISER VIA GPS"),
              style: OutlinedButton.styleFrom(foregroundColor: legoRed, side: BorderSide(color: legoRed, width: 2)),
            ),
          ),
      ],
    );
  }

  Widget _buildField(String label, TextEditingController controller, {int maxLines = 1}) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 20),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(label, style: const TextStyle(fontWeight: FontWeight.w900, fontSize: 13)),
          const SizedBox(height: 8),
          _isEditing
              ? TextField(controller: controller, maxLines: maxLines, decoration: const InputDecoration(filled: true, fillColor: Colors.white, border: OutlineInputBorder()))
              : Container(
            width: double.infinity,
            padding: const EdgeInsets.all(15),
            decoration: BoxDecoration(color: Colors.white, border: Border.all(color: Colors.black, width: 2), borderRadius: BorderRadius.circular(12)),
            child: Text(controller.text, style: const TextStyle(fontSize: 15, fontWeight: FontWeight.bold)),
          ),
        ],
      ),
    );
  }
}
