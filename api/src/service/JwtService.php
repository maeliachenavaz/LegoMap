<?php

namespace api\service;

class JwtService
{
    private string $secretKey;
    private string $refreshSecretKey;
    private int $accessTokenExpiry;
    private int $refreshTokenExpiry;

    public function __construct()
    {
        $this->secretKey = 'LEGO_MAP_SECRET_KEY';
        $this->refreshSecretKey = 'LEGO_MAP_REFRESH_SECRET_KEY';
        $this->accessTokenExpiry = 900;      // 15 minutes
        $this->refreshTokenExpiry = 604800;  // 7 jours
    }

    // Login
    public function login(string $email, string $password): bool
    {

    }

    // Register
    public function register(string $email, string $password): bool
    {

    }

    // Delete
    public function logout(): bool
    {

    }

    // isAuth
    public function isAuthenticated(): bool
    {

    }
}
