<?php

namespace App\Controller;

class HomeController extends BaseController
{
    public function index(): void
    {
        if (!isset($_SESSION['cached_stores'])) {
            $result = $this->callApi('http://api/stores');
            if (is_array($result) && !isset($result['error'])) {
                $_SESSION['cached_stores'] = $result;
            }
        }

        $allStores = $_SESSION['cached_stores'] ?? [];
        $result = $allStores;

        $query = isset($_GET['q']) ? trim($_GET['q']) : '';
        $sort  = $_GET['sort'] ?? '';

        if (is_array($result) && !isset($result['error'])) {
            $stores = $result;

            if ($query !== '') {
                $search = strtolower($query);
                $stores = array_filter($stores, function ($store) use ($search) {
                    $nom   = strtolower($store['nom'] ?? '');
                    $ville = strtolower($store['ville'] ?? '');
                    return str_contains($nom, $search) || str_contains($ville, $search);
                });
                $stores = array_values($stores);
            }

            if ($sort === 'asc') {
                usort($stores, fn($a, $b) => ($a['avis'] ?? 0) <=> ($b['avis'] ?? 0));
            } elseif ($sort === 'desc') {
                usort($stores, fn($a, $b) => ($b['avis'] ?? 0) <=> ($a['avis'] ?? 0));
            }
        }

        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';

        if ($isAjax) {
            echo $this->twig->render('Template/list_item.html.twig', [
                'stores' => $stores
            ]);
            exit;
        }

        echo $this->twig->render('home.html.twig', [
            'stores' => $stores,
            'q' => $query,
            'sort' => $sort
        ]);
    }
    public function users(): void
    {
        $result = $this->callApi('http://api/users');

        $users = [];
        if (is_array($result) && !isset($result['error'])) {
            $users = array_filter($result, function($u) {
                return isset($u['role']) && strtolower($u['role']) !== 'admin';
            });
        }

        echo $this->twig->render('users.html.twig', [
            'users' => $users
        ]);
    }
}
