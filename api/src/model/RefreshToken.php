<?php

namespace api\model;

use api\config\Database;
use PDO;

class RefreshToken
{
    private ?string $id = null;
    private string $user_id;
    private string $token_hash;
    private string $jti;
    private string $expires_at;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getTokenHash(): string
    {
        return $this->token_hash;
    }

    public function getJti(): string
    {
        return $this->jti;
    }

    public function getExpiresAt(): string
    {
        return $this->expires_at;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setUserId(string $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function setTokenHash(string $token_hash): self
    {
        $this->token_hash = $token_hash;
        return $this;
    }

    public function setJti(string $jti): self
    {
        $this->jti = $jti;
        return $this;
    }

    public function setExpiresAt(string $expires_at): self
    {
        $this->expires_at = $expires_at;
        return $this;
    }

    public static function create(RefreshToken $refreshToken): bool
    {
        $db = Database::getConnection();

        $refreshToken->id = self::generateUuid();

        $stmt = $db->prepare('
            INSERT INTO refresh_token (id, user_id, token_hash, jti, expires_at) 
            VALUES (:id, :user_id, :token_hash, :jti, :expires_at)
        ');

        return $stmt->execute([
            ':id' => $refreshToken->getId(),
            ':user_id' => $refreshToken->getUserId(),
            ':jti' => $refreshToken->getJti(),
            ':token_hash' => $refreshToken->getTokenHash(),
            ':expires_at' => $refreshToken->getExpiresAt()
        ]);
    }

    public static function getByTokenHash(string $token_hash): ?self
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM refresh_token WHERE token_hash = :token_hash');
        $stmt->execute([':token_hash' => $token_hash]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $token = new self();
        $token->setId($data['id']);
        $token->setUserId($data['user_id']);
        $token->setTokenHash($data['token_hash']);
        $token->setJti($data['jti']);
        $token->setExpiresAt($data['expires_at']);
        $token->created_at = $data['created_at'] ?? null;
        $token->updated_at = $data['updated_at'] ?? null;

        return $token;
    }

    public static function update(RefreshToken $refreshToken): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE refresh_token SET token_hash = :token_hash, jti = :jti, expires_at = :expires_at WHERE id = :id');
        return $stmt->execute([
            ':token_hash' => $refreshToken->getTokenHash(),
            ':expires_at' => $refreshToken->getExpiresAt(),
            ':jti' => $refreshToken->getJti(),
            ':id' => $refreshToken->getId()
        ]);
    }

    public static function deleteByJti(string $jti): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('DELETE FROM refresh_token WHERE jti = :jti');
        return $stmt->execute([':jti' => $jti]);
    }

    public static function deleteByUserId(string $userId): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('DELETE FROM refresh_token WHERE user_id = :user_id');
        return $stmt->execute([':user_id' => $userId]);
    }

    private static function generateUuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
