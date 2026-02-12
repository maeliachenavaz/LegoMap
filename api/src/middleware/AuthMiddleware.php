<?php

namespace api\middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class AuthMiddleware
{
    private static string $secret = "LEGO_SECRET_KEY";

    public static function verify(): object
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            exit(json_encode(['error' => 'Token manquant']));
        }

        if (!preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            http_response_code(401);
            exit(json_encode(['error' => 'Format token invalide']));
        }

        $jwt = $matches[1];

        try {
            return JWT::decode($jwt, new Key(self::$secret, 'HS256'));
        } catch (\Exception $e) {
            http_response_code(401);
            exit(json_encode(['error' => 'Token invalide ou expiré']));
        }
    }
}