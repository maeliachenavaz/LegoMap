<?php

namespace App\Controller;

class HomeController extends BaseController
{
    /**
     * Page d'accueil : Liste des stores avec filtres et tris
     */
    public function index(): void
    {
        // callApi gère la vérification de session et le refresh token automatiquement
        $result = $this->callApi('http://api/stores');

        $stores = [];
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';
        $sort  = $_GET['sort'] ?? '';

        if (is_array($result) && !isset($result['error'])) {
            $stores = $result;

            // 🔎 FILTRAGE (Nom ou Ville)
            if ($query !== '') {
                $search = strtolower($query);
                $stores = array_filter($stores, function ($store) use ($search) {
                    $nom   = strtolower($store['nom'] ?? '');
                    $ville = strtolower($store['ville'] ?? '');
                    return str_contains($nom, $search) || str_contains($ville, $search);
                });
                $stores = array_values($stores);
            }

            // ⭐ TRI (Avis)
            if ($sort === 'asc') {
                usort($stores, fn($a, $b) => ($a['avis'] ?? 0) <=> ($b['avis'] ?? 0));
            } elseif ($sort === 'desc') {
                usort($stores, fn($a, $b) => ($b['avis'] ?? 0) <=> ($a['avis'] ?? 0));
            }
        }

        echo $this->twig->render('home.html.twig', [
            'title'  => 'Accueil',
            'stores' => $stores,
            'q'      => $query,
            'sort'   => $sort
        ]);
    }

    /**
     * Liste des utilisateurs (hors administrateurs)
     */
    public function users(): void
    {
        $result = $this->callApi('http://api/users');

        $users = [];
        if (is_array($result) && !isset($result['error'])) {
            $users = array_filter($result, function($u) {
                // On exclut les admins de la liste
                return isset($u['role']) && strtolower($u['role']) !== 'admin';
            });
        }

        echo $this->twig->render('users.html.twig', [
            'users' => $users
        ]);
    }
}