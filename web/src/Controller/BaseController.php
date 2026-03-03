<?php

namespace App\Controller;

abstract class BaseController extends TwigController
{
    /**
     * Centralise les appels API avec gestion auto des tokens et du refresh
     */
    protected function callApi(string $url, string $method = 'GET', array $data = null)
    {
        // 1. Récupération des jetons stockés en session
        $accessToken = $_SESSION['user_tokens']['access_token'] ?? null;
        $refreshToken = $_SESSION['user_tokens']['refresh_token'] ?? null;

        // 2. Préparation des headers de la requête
        $headers = [
            "Content-Type: application/json",
            "Accept: application/json"
        ];

        if ($accessToken) {
            $headers[] = "Authorization: Bearer $accessToken";
        }
        if ($refreshToken) {
            $headers[] = "X-Refresh-Token: $refreshToken";
        }

        // 3. Configuration du contexte HTTP
        $options = [
            'http' => [
                'method'        => $method,
                'header'        => implode("\r\n", $headers),
                'content'       => $data ? json_encode($data) : null,
                'ignore_errors' => true // Permet de lire le JSON même en cas d'erreur (401, 404, etc.)
            ]
        ];

        $context = stream_context_create($options);
        $responseBody = @file_get_contents($url, false, $context);

        // Récupération des headers de réponse (variable magique PHP)
        $headersResponse = $http_response_header ?? [];
        $statusLine = $headersResponse[0] ?? '';

        // 4. ANALYSE DU REFRESH TOKEN (Header envoyé par l'API)
        foreach ($headersResponse as $h) {
            if (stripos($h, 'X-New-Access-Token:') === 0) {
                $_SESSION['user_tokens']['access_token'] = trim(substr($h, 19));
            }
            if (stripos($h, 'X-New-Refresh-Token:') === 0) {
                $_SESSION['user_tokens']['refresh_token'] = trim(substr($h, 20));
            }
        }

        // 5. GESTION DES ERREURS D'AUTHENTIFICATION (401)
        // On ne redirige pas si on est déjà sur la page de login pour éviter une boucle infinie
        $isLoginUrl = str_contains($url, '/login');

        if (str_contains($statusLine, '401') && !$isLoginUrl) {
            unset($_SESSION['user_tokens']);
            header('Location: /login?error=session_expired');
            exit;
        }

        return json_decode($responseBody, true);
    }
}