<?php

namespace api\service;

use api\model\User;
use api\model\RefreshToken;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class AuthService
{
    private static function secret(): string
    {
        // On s'assure que la clé existe, sinon on lève une exception claire
        if (!isset($_ENV['JWT_SECRET'])) {
            throw new Exception("JWT_SECRET non défini dans l'environnement.");
        }
        return $_ENV['JWT_SECRET'];
    }

    /**
     * Génère un UUID v4 pour les JTI (Refresh Tokens)
     */
    private static function generateUuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Vérifie l'access token et le rafraîchit si nécessaire via le header
     */
    public static function checkAndRefresh(): array
    {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? '';
        $jwt = null;

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $jwt = $matches[1];
        }

        if (!$jwt) {
            http_response_code(401);
            echo json_encode(['error' => 'Token manquant']);
            exit;
        }

        try {
            $decoded = JWT::decode($jwt, new Key(self::secret(), 'HS256'));
            return [
                'user_id' => $decoded->sub,
                'access_token' => $jwt
            ];
        } catch (\Firebase\JWT\ExpiredException $e) {
            // Si expiré, on cherche le refresh token dans les headers
            $refreshTokenPlain = $headers['X-Refresh-Token'] ?? $headers['x-refresh-token'] ?? null;

            if (!$refreshTokenPlain) {
                http_response_code(401);
                echo json_encode(['error' => 'Session expirée, merci de vous reconnecter']);
                exit;
            }

            try {
                $tokens = self::refresh($refreshTokenPlain);

                // On renvoie les nouveaux tokens dans les headers pour que le client les mette à jour
                header('X-New-Access-Token: ' . $tokens['access_token']);
                header('X-New-Refresh-Token: ' . $tokens['refresh_token']);

                $decodedNew = JWT::decode($tokens['access_token'], new Key(self::secret(), 'HS256'));
                return ['user_id' => $decodedNew->sub];
            } catch (Exception $ex) {
                http_response_code(401);
                echo json_encode(['error' => $ex->getMessage()]);
                exit;
            }
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Token invalide']);
            exit;
        }
    }

    /**
     * Inscription d'un nouvel utilisateur
     */
    public static function register(string $name, string $email, string $password, string $role): array
    {
        if (User::getByEmail($email)) {
            throw new Exception("Cet email est déjà utilisé.");
        }

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);

        $roleEnum = \api\model\Role::tryFrom($role) ?? \api\model\Role::USER;
        $user->setRole($roleEnum);

        $userId = $user->create();

        if (!$userId) {
            throw new Exception("Erreur lors de la création de l'utilisateur.");
        }

        // On génère directement les tokens après l'inscription
        return self::generateTokens($userId);
    }

    /**
     * Connexion
     */
    public static function login(string $email, string $password): array
    {
        $user = User::getByEmail($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            throw new Exception("Identifiants invalides.");
        }

        return self::generateTokens($user->getId());
    }

    /**
     * Génère le couple Access/Refresh Token
     */
    private static function generateTokens(string $userId): array
    {
        $now = time();

        $user = User::getById($userId);
        $roleValue = $user ? $user->getRole()->value : 'USER';

        // 1. Access Token (15 minutes)
        $accessPayload = [
            'iss' => 'legomap',
            'sub' => $userId,
            'role' => $roleValue,
            'iat' => $now,
            'exp' => $now + (60 * 15)
        ];
        $accessToken = JWT::encode($accessPayload, self::secret(), 'HS256');

        // 2. Refresh Token
        $refreshTokenPlain = bin2hex(random_bytes(64));
        $refreshTokenHash = hash('sha256', $refreshTokenPlain);
        $jti = self::generateUuid();

        $refresh = new RefreshToken();
        $refresh->setJti($jti); // Crucial pour ne pas avoir l'erreur 1364
        $refresh->setUserId($userId);
        $refresh->setTokenHash($refreshTokenHash);
        // Expire dans 7 jours
        $refresh->setExpiresAt(date('Y-m-d H:i:s', $now + (60 * 60 * 24 * 7)));

        // Sauvegarde en base
        if (!RefreshToken::create($refresh)) {
            throw new Exception("Impossible de créer la session (Refresh Token).");
        }

        return [
            'user_id'       => $userId,
            'role'          => $roleValue,
            'access_token'  => $accessToken,
            'refresh_token' => $refreshTokenPlain,
            'expires_in'    => 900
        ];
    }

    /**
     * Rafraîchit les tokens à partir d'un refresh token valide
     */
    public static function refresh(string $refreshTokenPlain): array
    {
        $hash = hash('sha256', $refreshTokenPlain);
        $stored = RefreshToken::getByTokenHash($hash);

        if (!$stored) {
            throw new Exception("Session invalide.");
        }

        if (strtotime($stored->getExpiresAt()) < time()) {
            RefreshToken::deleteByJti($stored->getJti());
            throw new Exception("Session expirée.");
        }

        // On supprime l'ancien refresh token (usage unique)
        RefreshToken::deleteByJti($stored->getJti());

        // On en génère des nouveaux
        return self::generateTokens($stored->getUserId());
    }

    public static function logout(string $userId): bool
    {
        return RefreshToken::deleteByUserId($userId);
    }
}
