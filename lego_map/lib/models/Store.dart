import 'dart:convert';

class Store {
  String id;
  String nom;
  String description;
  String date;
  int avis;
  double latitude;
  double longitude;
  String contactNom;
  String contactEmail;
  String photo;
  String creatorId;

  Store({
    required this.id,
    required this.nom,
    required this.description,
    required this.date,
    required this.avis,
    required this.latitude,
    required this.longitude,
    required this.contactNom,
    required this.contactEmail,
    required this.photo,
    required this.creatorId,
  });

  Map<String, dynamic> toMap() {
    return {
      'id': id,
      'nom': nom,
      'description': description,
      'date': date,
      'avis': avis,
      'latitude': latitude,
      'longitude': longitude,
      'contactNom': contactNom,
      'contactEmail': contactEmail,
      'photo': photo,
      'creator_id': creatorId,
    };
  }

  String toJson() => json.encode(toMap());

  factory Store.fromMap(Map<String, dynamic> map) {
    return Store(
      id: map['id'] ?? '',
      nom: map['nom'] ?? '',
      description: map['description'] ?? '',
      date: map['date'] ?? '',
      avis: map['avis'] is int ? map['avis'] : int.tryParse(map['avis'].toString()) ?? 0,
      latitude: map['latitude'] is double ? map['latitude'] : double.tryParse(map['latitude'].toString()) ?? 0.0,
      longitude: map['longitude'] is double ? map['longitude'] : double.tryParse(map['longitude'].toString()) ?? 0.0,
      contactNom: map['contactNom'] ?? map['contact_nom'] ?? '', // Gère les deux formats possibles
      contactEmail: map['contactEmail'] ?? map['contact_email'] ?? '',
      photo: map['photo'] ?? '',
      creatorId: map['creator_id'] ?? '',
    );
  }

  factory Store.fromJson(String source) => Store.fromMap(json.decode(source));
}
