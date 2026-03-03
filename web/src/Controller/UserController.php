<?php

namespace App\Controller;

class UserController extends BaseController
{
    /**
     * Connexion à l'espace Admin
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Appel direct à l'API sans token (méthode login)
            $result = $this->callApi('http://api/login', 'POST', [
                'email' => $email,
                'password' => $password
            ]);

            // Si l'API renvoie une erreur ou que le rôle n'est pas admin
            if (isset($result['error'])) {
                echo $this->twig->render('login.html.twig', [
                    'error' => $result['error']
                ]);
                return;
            }

            $role = $result['role'] ?? 'user';
            if (strtolower($role) !== 'admin') {
                echo $this->twig->render('login.html.twig', [
                    'error' => "Accès restreint aux administrateurs."
                ]);
                return;
            }

            // Succès : On stocke les tokens en session
            $_SESSION['user_tokens'] = $result;
            header('Location: /');
            exit;
        }

        echo $this->twig->render('login.html.twig');
    }

    /**
     * Déconnexion
     */
    public function logout(): void
    {
        // Optionnel : Appeler l'API logout pour invalider le refresh token en DB
        $this->callApi('http://api/logout', 'POST');

        session_destroy();
        header('Location: /login');
        exit;
    }

    /**
     * Création d'un utilisateur
     */
    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name'     => $_POST['name'] ?? '',
                'email'    => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? ''
            ];

            $result = $this->callApi('http://api/users', 'POST', $data);

            if (!isset($result['error'])) {
                header('Location: /users');
                exit;
            }

            echo $this->twig->render('user_form.html.twig', [
                'title' => 'Ajouter un utilisateur',
                'error' => $result['error']
            ]);
            return;
        }

        echo $this->twig->render('user_form.html.twig', ['title' => 'Ajouter un utilisateur']);
    }

    /**
     * Edition d'un utilisateur
     */
    public function edit(string $id): void
    {
        // 1. Récupération des données actuelles
        $user = $this->callApi("http://api/users/$id");

        if (!$user || isset($user['error'])) {
            header('Location: /users');
            exit;
        }

        // 2. Traitement de la modification
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name'  => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? ''
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
            }

            $result = $this->callApi("http://api/users/$id", 'PUT', $data);

            if (!isset($result['error'])) {
                header('Location: /users');
                exit;
            }

            echo $this->twig->render('user_form.html.twig', [
                'title' => 'Modifier l\'utilisateur',
                'user'  => ['id' => $id, 'name' => $_POST['name'], 'email' => $_POST['email']],
                'error' => $result['error']
            ]);
            return;
        }

        echo $this->twig->render('user_form.html.twig', [
            'title' => 'Modifier l\'utilisateur',
            'user'  => $user
        ]);
    }

    /**
     * Suppression d'un utilisateur
     */
    public function delete(string $id): void
    {
        $result = $this->callApi("http://api/users/$id", 'DELETE');

        if (!isset($result['error'])) {
            http_response_code(200);
            echo json_encode(['message' => 'Utilisateur supprimé']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => $result['error']]);
        }
        exit;
    }
}