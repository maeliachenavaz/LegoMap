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
            $role = $data['role'] ?? 'USER';
            $tokens = AuthService::register($data['name'], $data['email'], $data['password'], $role);

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

    public static function addUser(): void
    {
        try {
            // 1. Sécurité : Vérifier le token et le rôle Admin
            $authData = AuthService::checkAndRefresh();
            $currentUser = User::getById($authData['user_id']);

            if (!$currentUser || $currentUser->getRole() !== \api\model\Role::ADMIN) {
                http_response_code(403);
                echo json_encode(['error' => 'Accès refusé. Seul un administrateur peut créer des utilisateurs.']);
                return;
            }

            // 2. Récupérer les données JSON
            $data = json_decode(file_get_contents('php://input'), true);

            if (!isset($data['name'], $data['email'], $data['password'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Données incomplètes (nom, email et mot de passe requis)']);
                return;
            }

            // 3. Création de l'objet User
            $user = new User();
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']); // Sera haché dans la méthode create()

            // On force le rôle USER pour les nouveaux comptes créés par l'admin
            $user->setRole(\api\model\Role::USER);

            $id = $user->create();

            if ($id) {
                http_response_code(201);
                echo $user->toJson();
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Erreur lors de la création en base de données.']);
            }
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
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

    // Dans api/src/controller/UserController.php

    public static function getAllUsers(): void
    {
        try {
            // 1. Vérifier si l'appelant est bien admin (sécurité API)
            AuthService::checkAndRefresh();

            // 2. Récupérer tous les users via le modèle
            $users = User::findAll(); // On va créer findAll() juste après

            $data = [];
            foreach ($users as $user) {
                // On utilise votre méthode toJsonArray ou manuellement :
                $data[] = [
                    'id'    => $user->getId(),
                    'name'  => $user->getName(),
                    'email' => $user->getEmail(),
                    'role'  => $user->getRole()->value
                ];
            }

            http_response_code(200);
            echo json_encode($data);
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
        }
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
        error_log("Data reçue : " . print_r($data, true)); // Regardez vos logs serveurs

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

        $userToDelete = User::getById($id);

        $authData = AuthService::checkAndRefresh();

        $currentUser = User::getById($authData['user_id']);

        if ($currentUser->getRole() !== \api\model\Role::ADMIN) {
            http_response_code(403);
            echo json_encode(['error' => 'Seul un administrateur peut supprimer des comptes.']);
            return;
        }

        if (!$userToDelete) {
            http_response_code(404);
            echo json_encode(['error' => 'Utilisateur non trouvé']);
            return;
        }

        if ($userToDelete->getRole() === \api\model\Role::ADMIN) {
            http_response_code(403); // Forbidden
            echo json_encode(['error' => 'Interdiction de supprimer un compte administrateur.']);
            return;
        }

        $success = User::delete($id);

        if ($success) {
            http_response_code(200);
            echo json_encode(['message' => 'Utilisateur supprimé avec succès']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de la suppression en base de données']);
        }
    }
}
