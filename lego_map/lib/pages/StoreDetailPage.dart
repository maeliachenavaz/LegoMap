import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:flutter_map/flutter_map.dart';
import 'package:latlong2/latlong.dart';
import '../models/Store.dart';

class StoreDetailPage extends StatelessWidget {
  final Store store;

  const StoreDetailPage({super.key, required this.store});

  final Color legoRed = const Color(0xFFD11013);
  final Color legoYellow = const Color(0xFFFACB16);
  final Color bgGray = const Color(0xFFF3F4F6);

  @override
  Widget build(BuildContext context) {
    final LatLng storeLocation = LatLng(store.latitude, store.longitude);

    return Scaffold(
      backgroundColor: bgGray,
      appBar: AppBar(
        backgroundColor: legoYellow,
        elevation: 4,
        shadowColor: Colors.black.withOpacity(0.5),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.black),
          onPressed: () => Navigator.of(context).pop(),
        ),
        title: Text(
          store.nom.toUpperCase(),
          style: const TextStyle(
              color: Colors.black,
              fontWeight: FontWeight.w900,
              letterSpacing: 1.2
          ),
        ),
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Container(
              height: 250,
              width: double.infinity,
              decoration: const BoxDecoration(
                color: Colors.white,
                border: Border(bottom: BorderSide(color: Colors.black, width: 3)),
              ),
              child: store.photo != null && store.photo!.isNotEmpty
                  ? Image.memory(
                base64Decode(store.photo!.split(',').last),
                fit: BoxFit.cover,
              )
                  : const Center(
                child: Text("🧱", style: TextStyle(fontSize: 100)),
              ),
            ),

            Padding(
              padding: const EdgeInsets.all(20.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Expanded(
                        child: Text(
                          store.nom,
                          style: TextStyle(
                              fontSize: 28,
                              fontWeight: FontWeight.w900,
                              color: legoRed
                          ),
                        ),
                      ),
                      _buildRatingBadge(store.avis),
                    ],
                  ),
                  const SizedBox(height: 5),
                  Text(
                    "CONSTRUCTION LE : ${store.date}",
                    style: const TextStyle(
                        fontWeight: FontWeight.w800,
                        color: Colors.grey,
                        fontSize: 12
                    ),
                  ),

                  const Divider(height: 40, thickness: 2, color: Colors.black),

                  const Text(
                      "À PROPOS",
                      style: TextStyle(fontWeight: FontWeight.w900, fontSize: 18)
                  ),
                  const SizedBox(height: 10),
                  Text(
                    store.description,
                    style: const TextStyle(fontSize: 16, height: 1.5),
                  ),

                  const SizedBox(height: 30),

                  _buildInfoTile(Icons.person, "CONTACT", store.contactNom),
                  _buildInfoTile(Icons.email, "EMAIL", store.contactEmail),

                  const SizedBox(height: 25),

                  const Text(
                      "LOCALISATION",
                      style: TextStyle(fontWeight: FontWeight.w900, fontSize: 18)
                  ),
                  const SizedBox(height: 12),



                  Container(
                    height: 250,
                    decoration: BoxDecoration(
                      color: Colors.white,
                      border: Border.all(color: Colors.black, width: 3),
                      borderRadius: BorderRadius.circular(15),
                      boxShadow: const [
                        BoxShadow(color: Colors.black, offset: Offset(4, 4))
                      ],
                    ),
                    child: ClipRRect(
                      borderRadius: BorderRadius.circular(12),
                      child: FlutterMap(
                        options: MapOptions(
                          initialCenter: storeLocation,
                          initialZoom: 15.0,
                        ),
                        children: [
                          TileLayer(
                            urlTemplate: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                            userAgentPackageName: 'com.your.app.name',
                          ),
                          MarkerLayer(
                            markers: [
                              Marker(
                                point: storeLocation,
                                width: 50,
                                height: 50,
                                child: Icon(
                                  Icons.location_on,
                                  color: legoRed,
                                  size: 45,
                                  shadows: const [
                                    Shadow(color: Colors.white, blurRadius: 10)
                                  ],
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                  ),
                  const SizedBox(height: 30),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildRatingBadge(int note) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
      decoration: BoxDecoration(
        color: legoYellow,
        border: Border.all(color: Colors.black, width: 2),
        borderRadius: BorderRadius.circular(10),
        boxShadow: const [BoxShadow(color: Colors.black, offset: Offset(3, 3))],
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Text(
              "$note",
              style: const TextStyle(fontWeight: FontWeight.w900, fontSize: 20)
          ),
          const SizedBox(width: 4),
          const Icon(Icons.star, color: Colors.black, size: 22),
        ],
      ),
    );
  }

  Widget _buildInfoTile(IconData icon, String label, String value) {
    return Container(
      margin: const EdgeInsets.only(bottom: 15),
      padding: const EdgeInsets.all(15),
      decoration: BoxDecoration(
        color: Colors.white,
        border: Border.all(color: Colors.black, width: 2),
        borderRadius: BorderRadius.circular(12),
        boxShadow: const [BoxShadow(color: Colors.black12, offset: Offset(2, 2))],
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(8),
            decoration: BoxDecoration(
              color: legoYellow.withOpacity(0.2),
              shape: BoxShape.circle,
            ),
            child: Icon(icon, color: legoRed, size: 24),
          ),
          const SizedBox(width: 15),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                    label,
                    style: TextStyle(
                        fontSize: 10,
                        fontWeight: FontWeight.w900,
                        color: legoRed.withOpacity(0.7)
                    )
                ),
                Text(
                    value,
                    style: const TextStyle(fontSize: 16, fontWeight: FontWeight.w800)
                ),
              ],
            ),
          )
        ],
      ),
    );
  }
}
