<?php

namespace App\Controller;

class UserController extends BaseController
{
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $result = $this->callApi('http://api/login', 'POST', [
                'email' => $email,
                'password' => $password
            ]);

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

            $_SESSION['user_tokens'] = $result;
            header('Location: /');
            exit;
        }

        echo $this->twig->render('login.html.twig');
    }

    public function logout(): void
    {
        $this->callApi('http://api/logout', 'POST');

        session_destroy();
        header('Location: /login');
        exit;
    }

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

    public function edit(string $id): void
    {
        $user = $this->callApi("http://api/users/$id");

        if (!$user || isset($user['error'])) {
            header('Location: /users');
            exit;
        }

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
