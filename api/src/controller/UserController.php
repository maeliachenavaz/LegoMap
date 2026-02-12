<?php

namespace api\controller;

use api\model\User;
use api\service\AuthService;

class UserController
{
    public static function register(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['name'], $data['email'], $data['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Paramètres manquants']);
            return;
        }

        try {
            $tokens = AuthService::register($data['name'], $data['email'], $data['password']);

            http_response_code(201);
            echo json_encode($tokens);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function login(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['email'], $data['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Paramètres manquants']);
            return;
        }

        try {
            $tokens = AuthService::login($data['email'], $data['password']);

            http_response_code(200);
            echo json_encode($tokens);
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function logout() : void
    {
        // 1. Lire le JSON brut depuis le body
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // 2. Récupérer l'user_id
        $userId = $data['user_id'] ?? null;

        if (!$userId) {
            http_response_code(400);
            echo json_encode(['error' => 'user_id manquant dans le body']);
            return;
        }

        // 3. Supprimer les tokens en base
        $success = AuthService::logout($userId);

        if ($success) {
            http_response_code(200);
            echo json_encode(['message' => "Utilisateur $userId déconnecté avec succès."]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de la déconnexion en base de données']);
        }
    }

    public static function getUser(string $id): void
    {
        AuthService::checkAndRefresh();

        $user = User::getById($id);

        if (!$user) {
            http_response_code(404);
            echo json_encode(['error' => 'Utilisateur non trouvé']);
            return;
        }

        http_response_code(200);
        echo $user->toJson();
    }

    public static function updateUser(string $id): void
    {
        AuthService::checkAndRefresh();

        $user = User::getById($id);

        if (!$user) {
            http_response_code(404);
            echo json_encode(['error' => 'Utilisateur non trouvé']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['name'])) $user->setName($data['name']);
        if (isset($data['email'])) $user->setEmail($data['email']);
        if (isset($data['password'])) $user->setPassword($data['password']);

        $success = $user->update();

        if ($success) {
            http_response_code(200);
            echo $user->toJson();
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de la mise à jour']);
        }
    }

    public static function deleteUser(string $id): void
    {
        AuthService::checkAndRefresh();

        $user = User::getById($id);

        if (!$user) {
            http_response_code(404);
            echo json_encode(['error' => 'Utilisateur non trouvé']);
            return;
        }

        $success = User::delete($id);

        if ($success) {
            http_response_code(200);
            echo json_encode(['message' => 'Utilisateur supprimé']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de la suppression']);
        }
    }
}
