<?php

namespace App\Controller;

abstract class BaseController extends TwigController
{
    /**
     * @param array<string, mixed>|null $data
     * @return mixed
     */
    protected function callApi(string $url, string $method = 'GET', array $data = null, bool $protected = true)
    {
        $headers = [
            "Content-Type: application/json",
            "Accept: application/json"
        ];

        if ($protected) {
            $accessToken = $_SESSION['user_tokens']['access_token'] ?? null;
            $refreshToken = $_SESSION['user_tokens']['refresh_token'] ?? null;

            if ($accessToken) {
                $headers[] = "Authorization: Bearer $accessToken";
            }
            if ($refreshToken) {
                $headers[] = "X-Refresh-Token: $refreshToken";
            }
        }

        $options = [
            'http' => [
                'method'        => $method,
                'header'        => implode("\r\n", $headers),
                'content'       => $data ? json_encode($data) : null,
                'ignore_errors' => true
            ]
        ];

        $context = stream_context_create($options);
        $responseBody = file_get_contents($url, false, $context);

        $headersResponse = $http_response_header;
        $statusLine = $headersResponse[0] ?? '';

        foreach ($headersResponse as $h) {
            if (stripos($h, 'X-New-Access-Token:') === 0) {
                $_SESSION['user_tokens']['access_token'] = trim(substr($h, 19));
            }
            if (stripos($h, 'X-New-Refresh-Token:') === 0) {
                $_SESSION['user_tokens']['refresh_token'] = trim(substr($h, 20));
            }
        }

        $isLoginUrl = str_contains($url, '/login');

        if (str_contains($statusLine, '401') && !$isLoginUrl) {
            unset($_SESSION['user_tokens']);
            header('Location: /login?error=session_expired');
            exit;
        }

        return json_decode($responseBody, true);
    }
}
