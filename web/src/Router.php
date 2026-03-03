<?php

namespace App;

use App\Controller\HomeController;
use App\Controller\UserController;
use App\Controller\StoreController;

class Router
{
    public function dispatch(string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        // --- ROUTES STATIQUES ---
        switch ($path) {
            case '/':
                (new HomeController())->index();
                return;

            case '/login':
                (new UserController())->login();
                return;

            case '/logout':
                (new UserController())->logout();
                return;

            case '/users': // <--- AJOUTE CETTE ROUTE
                (new HomeController())->users();
                return;

            case '/users/create':
                (new \App\Controller\UserController())->create();
                return;

            case '/store/create':
                (new StoreController())->create();
                return;
        }

        // --- ROUTE DYNAMIQUE /store/{id} ---
        if (preg_match('#^/store/([\w-]+)$#', $path, $matches)) {
            // Ici on capture aussi les UUID avec des "-"
            $id = $matches[1];
            (new StoreController())->detail($id);
            return;
        }

        // --- ROUTE DYNAMIQUE /store/{id}/edit ---
        if (preg_match('#^/store/([\w-]+)/edit$#', $path, $matches)) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'POST') {
                (new StoreController())->edit($id);
            } else {
                header("HTTP/1.1 405 Method Not Allowed");
                echo "Méthode non autorisée";
            }
            return;
        }

        if (preg_match('#^/store/([\w-]+)/delete$#', $path, $matches)) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new StoreController())->delete($matches[1]);
            } else {
                header("HTTP/1.1 405 Method Not Allowed");
                echo "Méthode non autorisée";
            }
        }

        // --- ROUTE DYNAMIQUE /store/{id}/pdf ---
        if (preg_match('#^/store/([\w-]+)/pdf$#', $path, $matches)) {
            $id = $matches[1];
            (new StoreController())->pdf($id);
            return;
        }

        if (preg_match('#^/store/preview/([\w-]+)$#', $path, $matches)) {
            $id = $matches[1];
            (new StoreController())->preview($id);
            return;
        }

        if (preg_match('#^/users/edit/([\w-]+)$#', $path, $matches)) {
            (new UserController())->edit($matches[1]);
            return;
        }

        if (preg_match('#^/users/delete/([\w-]+)$#', $path, $matches)) {
            (new UserController())->delete($matches[1]);
            return;
        }
    }
}