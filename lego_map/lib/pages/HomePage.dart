import 'package:flutter/material.dart';
import 'package:lego_map/router/Router.dart';
import '../services/StoreService.dart';
import '../models/Store.dart';
import 'dart:convert';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  final StoreService _storeService = StoreService();
  final ScrollController _scrollController = ScrollController();

  List<Store> _displayedStores = [];

  bool _isLoading = true;
  bool _isLoadingMore = false;
  bool _hasMoreData = true;

  int _currentPage = 1;
  final int _pageSize = 4;

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

  void _onScroll() {
    if (_scrollController.position.pixels >= _scrollController.position.maxScrollExtent * 0.8) {
      if (!_isLoadingMore && _hasMoreData) {
        _fetchNextPage();
      }
    }
  }

  Future<void> _fetchInitialStores() async {
    setState(() {
      _isLoading = true;
      _currentPage = 1;
      _hasMoreData = true;
    });

    try {
      final fetchedStores = await _storeService.getAllStores(
          page: _currentPage,
          limit: _pageSize
      );

      setState(() {
        _displayedStores = fetchedStores;
        _isLoading = false;
        if (fetchedStores.length < _pageSize) _hasMoreData = false;
      });
    } catch (e) {
      setState(() => _isLoading = false);
      _showSnackBar("Erreur de chargement : $e", Colors.red);
    }
  }

  Future<void> _fetchNextPage() async {
    setState(() => _isLoadingMore = true);
    _currentPage++;

    try {
      final newStores = await _storeService.getAllStores(
          page: _currentPage,
          limit: _pageSize
      );

      setState(() {
        if (newStores.isEmpty) {
          _hasMoreData = false;
        } else {
          _displayedStores.addAll(newStores);
          if (newStores.length < _pageSize) _hasMoreData = false;
        }
        _isLoadingMore = false;
      });
    } catch (e) {
      setState(() => _isLoadingMore = false);
      _showSnackBar("Erreur lors du chargement de la suite", legoRed);
    }
  }

  void _showSnackBar(String message, Color color) {
    ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text(message), backgroundColor: color)
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
      ),
      body: RefreshIndicator(
        onRefresh: _handleRefresh,
        color: legoRed,
        child: _isLoading
            ? const Center(child: CircularProgressIndicator(color: Colors.red))
            : _displayedStores.isEmpty
            ? _buildEmptyState()
            : ListView.builder(
          controller: _scrollController,
          physics: const AlwaysScrollableScrollPhysics(),
          padding: const EdgeInsets.all(16.0),
          // +1 pour afficher le loader en bas si on charge encore
          itemCount: _displayedStores.length + (_isLoadingMore ? 1 : 0),
          itemBuilder: (context, index) {
            if (index == _displayedStores.length) {
              return const Center(
                child: Padding(
                  padding: EdgeInsets.symmetric(vertical: 20),
                  child: CircularProgressIndicator(color: Colors.red),
                ),
              );
            }

            return Padding(
              padding: const EdgeInsets.only(bottom: 16.0),
              child: _buildStoreCard(_displayedStores[index]),
            );
          },
        ),
      ),
    );
  }

  Widget _buildStoreCard(Store store) {
    return InkWell(
      onTap: () {
        AppRouter.router.go('/store/${store.id}', extra: store);
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
                height: 180,
                width: double.infinity,
                color: legoYellow.withOpacity(0.3),
                child: store.photo != null && store.photo!.isNotEmpty
                    ? Image.memory(
                  base64Decode(store.photo!.split(',').last),
                  fit: BoxFit.cover,
                )
                    : const Center(child: Text("🧱", style: TextStyle(fontSize: 60))),
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
                    const SizedBox(width: 12),
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
                      decoration: BoxDecoration(
                        color: legoYellow,
                        borderRadius: BorderRadius.circular(8),
                        border: Border.all(color: Colors.black, width: 1.5),
                      ),
                      child: Row(
                        mainAxisSize: MainAxisSize.min,
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
      ),
    );
  }

  Widget _buildEmptyState() {
    return Center(
      child: SingleChildScrollView(
        physics: const AlwaysScrollableScrollPhysics(),
        child: Column(
          children: [
            const SizedBox(height: 50),
            Icon(Icons.extension_off, size: 80, color: legoYellow),
            const SizedBox(height: 10),
            const Text("Aucun store trouvé !", style: TextStyle(fontWeight: FontWeight.w900)),
          ],
        ),
      ),
    );
  }
}
