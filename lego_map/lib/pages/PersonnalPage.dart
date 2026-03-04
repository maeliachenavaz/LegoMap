import 'package:flutter/material.dart';
import '../router/Router.dart';
import '../services/StoreService.dart';
import '../models/Store.dart';
import 'dart:convert';

class PersonnalPage extends StatefulWidget {
  const PersonnalPage({super.key});

  @override
  State<PersonnalPage> createState() => _PersonnalPageState();
}

class _PersonnalPageState extends State<PersonnalPage> {
  final StoreService _storeService = StoreService();
  final ScrollController _scrollController = ScrollController();

  // État des données
  List<Store> _myStores = [];
  bool _isLoading = true;          // Chargement initial
  bool _isLoadingMore = false;     // Chargement pagination
  bool _hasMoreData = true;        // Stop si plus de données
  int _currentPage = 1;
  final int _pageSize = 4;         // Taille du lot

  final Color legoRed = const Color(0xFF7F1D1D);
  final Color legoYellow = const Color(0xFFFACB16);
  final Color bgGray = const Color(0xFFF3F4F6);

  @override
  void initState() {
    super.initState();
    _fetchInitialStores();
    _scrollController.addListener(_onScroll);
  }

  @override
  void dispose() {
    _scrollController.dispose();
    super.dispose();
  }

  // Détection du scroll à 80%
  void _onScroll() {
    if (_scrollController.position.pixels >= _scrollController.position.maxScrollExtent * 0.8) {
      if (!_isLoadingMore && _hasMoreData) {
        _fetchNextPage();
      }
    }
  }

  // Chargement initial (Page 1)
  Future<void> _fetchInitialStores() async {
    setState(() {
      _isLoading = true;
      _currentPage = 1;
      _hasMoreData = true;
    });

    try {
      // Note: Assure-toi que getMyStores accepte aussi page et limit dans ton StoreService
      final fetchedStores = await _storeService.getMyStores(
        page: _currentPage,
        limit: _pageSize,
      );

      setState(() {
        _myStores = fetchedStores;
        _isLoading = false;
        if (fetchedStores.length < _pageSize) _hasMoreData = false;
      });
    } catch (e) {
      setState(() => _isLoading = false);
      _showError("Erreur : $e");
    }
  }

  // Chargement des pages suivantes
  Future<void> _fetchNextPage() async {
    setState(() => _isLoadingMore = true);
    _currentPage++;

    try {
      final newStores = await _storeService.getMyStores(
        page: _currentPage,
        limit: _pageSize,
      );

      setState(() {
        if (newStores.isEmpty) {
          _hasMoreData = false;
        } else {
          _myStores.addAll(newStores);
          if (newStores.length < _pageSize) _hasMoreData = false;
        }
        _isLoadingMore = false;
      });
    } catch (e) {
      setState(() => _isLoadingMore = false);
    }
  }

  void _showError(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(message), backgroundColor: Colors.red),
    );
  }

  Future<void> _handleRefresh() async {
    await _fetchInitialStores();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: bgGray,
      appBar: AppBar(
        backgroundColor: legoYellow,
        elevation: 4,
        shadowColor: Colors.black.withOpacity(0.5),
        title: const Text(
            "LEGO Map",
            style: TextStyle(color: Colors.black, fontWeight: FontWeight.w900, letterSpacing: 1.5)
        ),
        actions: [
          IconButton(
            onPressed: () async {
              await AppRouter.router.push('/personnal/create');
              _fetchInitialStores(); // Rafraîchit tout après création
            },
            icon: const Icon(Icons.add_circle, color: Colors.black, size: 30),
          ),
          const SizedBox(width: 8),
        ],
      ),
      body: RefreshIndicator(
        onRefresh: _handleRefresh,
        color: legoRed,
        child: _isLoading
            ? const Center(child: CircularProgressIndicator(color: Colors.red))
            : _myStores.isEmpty
            ? _buildEmptyState()
            : ListView.builder(
          controller: _scrollController,
          physics: const AlwaysScrollableScrollPhysics(),
          padding: const EdgeInsets.all(16.0),
          // On ajoute +1 pour le Header, et éventuellement +1 pour le Loader
          itemCount: 1 + _myStores.length + (_isLoadingMore ? 1 : 0),
          itemBuilder: (context, index) {

            // 1. LE HEADER (Toujours à l'index 0)
            if (index == 0) {
              return Padding(
                padding: const EdgeInsets.only(bottom: 20.0),
                child: Text(
                  "Mes stores",
                  style: TextStyle(fontSize: 26, fontWeight: FontWeight.w900, color: legoRed),
                ),
              );
            }

            // 2. LE LOADER DE FIN
            // Il apparaît si on est au dernier index possible
            if (index == _myStores.length + 1) {
              return const Center(
                child: Padding(
                  padding: EdgeInsets.symmetric(vertical: 20),
                  child: CircularProgressIndicator(color: Colors.red),
                ),
              );
            }

            // 3. LES STORES
            // On utilise [index - 1] car l'index 0 est pris par le titre
            final store = _myStores[index - 1];
            return Padding(
              padding: const EdgeInsets.only(bottom: 16.0),
              child: _buildStoreCard(store),
            );
          },
        )
      ),
    );
  }

  Widget _buildStoreCard(Store store) {
    return InkWell(
        onTap: () async {
          await AppRouter.router.push('/personnal/manage/${store.id}', extra: store);
          _fetchInitialStores(); // Rafraîchit après modification/suppression
        },
        child: Container(
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(15),
            border: Border.all(color: Colors.black, width: 2),
            boxShadow: const [BoxShadow(color: Colors.black, offset: Offset(4, 4))],
          ),
          child: ClipRRect(
            borderRadius: BorderRadius.circular(13),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Container(
                  height: 160,
                  width: double.infinity,
                  color: legoYellow.withOpacity(0.3),
                  child: store.photo != null && store.photo!.isNotEmpty
                      ? Image.memory(
                    base64Decode(store.photo!.split(',').last),
                    fit: BoxFit.cover,
                  )
                      : const Center(child: Text("🧱", style: TextStyle(fontSize: 50))),
                ),
                Padding(
                  padding: const EdgeInsets.all(15),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Expanded(
                        child: Text(
                          store.nom.toUpperCase(),
                          style: TextStyle(fontSize: 18, fontWeight: FontWeight.w900, color: legoRed),
                          overflow: TextOverflow.ellipsis,
                        ),
                      ),
                      Container(
                        padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
                        decoration: BoxDecoration(
                          color: legoYellow,
                          borderRadius: BorderRadius.circular(8),
                          border: Border.all(color: Colors.black, width: 1.5),
                        ),
                        child: Row(
                          children: [
                            Text("${store.avis}", style: const TextStyle(fontWeight: FontWeight.w900, fontSize: 16)),
                            const Icon(Icons.star, color: Colors.black, size: 18),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
        ));
  }

  Widget _buildEmptyState() {
    return ListView( // Nécessaire pour le RefreshIndicator
      children: [
        const SizedBox(height: 100),
        Icon(Icons.layers_clear, size: 80, color: legoYellow),
        const SizedBox(height: 10),
        const Text(
          "Vous n'avez pas encore créé de store !",
          style: TextStyle(fontWeight: FontWeight.w900),
          textAlign: TextAlign.center,
        ),
      ],
    );
  }
}