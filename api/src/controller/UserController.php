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
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $userId = $data['user_id'] ?? null;

        if (!$userId) {
            http_response_code(400);
            echo json_encode(['error' => 'user_id manquant dans le body']);
            return;
        }

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
            $authData = AuthService::checkAndRefresh();
            $currentUser = User::getById($authData['user_id']);

            if (!$currentUser || $currentUser->getRole() !== \api\model\Role::ADMIN) {
                http_response_code(403);
                echo json_encode(['error' => 'Accès refusé. Seul un administrateur peut créer des utilisateurs.']);
                return;
            }

            $data = json_decode(file_get_contents('php://input'), true);

            if (!isset($data['name'], $data['email'], $data['password'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Données incomplètes (nom, email et mot de passe requis)']);
                return;
            }

            $user = new User();
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);

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
        try {
            $authData = AuthService::checkAndRefresh();
            $loggedUserId = $authData['user_id'];

            $currentUser = User::getById($loggedUserId);

            $currentUserRole = $currentUser->getRole()->value;

            if ($id !== $loggedUserId && strtolower($currentUserRole) !== 'admin') {
                http_response_code(403);
                echo json_encode(['error' => 'Accès interdit : vous ne pouvez consulter que votre propre profil.']);
                return;
            }

            $user = User::getById($id);

            if (!$user) {
                http_response_code(404);
                echo json_encode(['error' => 'Utilisateur non trouvé']);
                return;
            }

            http_response_code(200);
            echo $user->toJson();
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function getAllUsers(): void
    {
        try {
            $authData = AuthService::checkAndRefresh();
            $currentUser = User::getById($authData['user_id']);

            if (!$currentUser || $currentUser->getRole() !== \api\model\Role::ADMIN) {
                http_response_code(403);
                echo json_encode(['error' => 'Accès interdit : privilèges administrateur requis.']);
                return;
            }

            $users = User::findAll();

            $data = [];
            foreach ($users as $user) {
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
        try {
            $authData = AuthService::checkAndRefresh();
            $loggedUserId = $authData['user_id'];
            $currentUser = User::getById($loggedUserId);

            if ($id !== $loggedUserId && $currentUser->getRole() !== \api\model\Role::ADMIN) {
                http_response_code(403);
                echo json_encode(['error' => 'Accès interdit : modification non autorisée.']);
                return;
            }

            $userToUpdate = User::getById($id);
            if (!$userToUpdate) {
                http_response_code(404);
                echo json_encode(['error' => 'Utilisateur non trouvé']);
                return;
            }

            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['name'])) $userToUpdate->setName($data['name']);
            if (isset($data['email'])) $userToUpdate->setEmail($data['email']);
            if (isset($data['password'])) $userToUpdate->setPassword($data['password']);

            if ($userToUpdate->update()) {
                http_response_code(200);
                echo $userToUpdate->toJson();
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Erreur lors de la mise à jour']);
            }
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function deleteUser(string $id): void
    {
        try {
            $authData = AuthService::checkAndRefresh();
            $loggedUserId = $authData['user_id'];
            $currentUser = User::getById($loggedUserId);

            $userToDelete = User::getById($id);

            if ($id !== $loggedUserId && $currentUser->getRole() !== \api\model\Role::ADMIN) {
                http_response_code(403);
                echo json_encode(['error' => 'Accès interdit : vous ne pouvez pas supprimer ce compte.']);
                return;
            }

            if (!$userToDelete) {
                http_response_code(404);
                echo json_encode(['error' => 'Utilisateur non trouvé']);
                return;
            }

            if ($userToDelete->getRole() === \api\model\Role::ADMIN && $id !== $loggedUserId) {
                http_response_code(403);
                echo json_encode(['error' => 'Interdiction de supprimer un autre compte administrateur.']);
                return;
            }

            if (User::delete($id)) {
                http_response_code(200);
                echo json_encode(['message' => 'Compte supprimé avec succès']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Erreur lors de la suppression']);
            }
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
