<?php

namespace App\Controller;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends TwigController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index(): void
    {
        // Appel API
        $apiResponse = file_get_contents('http://api/users.php');
        $users = json_decode($apiResponse, true);

        echo $this->twig->render('home.html.twig', [
            'title' => 'Accueil',
            'users' => $users
        ]);
    }
}
