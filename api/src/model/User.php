<?php

namespace api\model;

use api\config\Database;
use PDO;

class User
{
    private string $id;
    private string $name;
    private string $email;
    private string $password;
    private Role $role;
    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    public function toJson(): string
    {
        return json_encode([
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role->value,
        ]);
    }

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);

        if (!is_array($data)) {
            throw new \InvalidArgumentException('JSON invalide');
        }

        $user = new self();

        if (isset($data['id'])) {
            $user->setId($data['id']);
        }

        if (isset($data['name'])) {
            $user->setName($data['name']);
        }

        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }

        if (isset($data['password'])) {
            $user->setPassword($data['password']);
        }

        if (isset($data['role'])) {
            $user->setRole(Role::from($data['role']));
        } else {
            $user->setRole(Role::USER);
        }

        return $user;
    }

    public function create(): ?string
    {
        $db = Database::getConnection();
        $this->id = self::generateUuid();

        $stmt = $db->prepare(
            "INSERT INTO user (id, name, email, password) 
         VALUES (:id, :name, :email, :password)"
        );

        $success = $stmt->execute([
            ':id'       => $this->id,
            ':name'     => $this->name,
            ':email'    => $this->email,
            ':password' => password_hash($this->password, PASSWORD_DEFAULT),
        ]);

        return $success ? $this->id : null;
    }

    public static function getById(string $id): ?User
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return null;

        $user = new self();
        $user->setId($data['id']);
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setRole(Role::from($data['role']));

        return $user;
    }

    public static function getByEmail(string $email): ?User
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return null;

        $user = new self();
        $user->setId($data['id']);
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        // AJOUTER CECI :
        $user->setRole(Role::from($data['role']));

        return $user;
    }

    /**
     * @return User[]
     */
    public static function findAll(): array
    {
        $db = \api\config\Database::getConnection();
        $stmt = $db->query("SELECT * FROM user ORDER BY name ASC");
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $user = new self();
            $user->setId($row['id']);
            $user->setName($row['name']);
            $user->setEmail($row['email']);
            $user->setRole(Role::from($row['role']));
            $users[] = $user;
        }

        return $users;
    }

    public function update(): bool
    {
        $db = Database::getConnection();

        $stmt = $db->prepare(
            "UPDATE user 
             SET name = :name, 
                 email = :email
             WHERE id = :id"
        );

        $params = [
            ':id'            => $this->id,
            ':name'           => $this->name,
            ':email'          => $this->email,
        ];

        $success = $stmt->execute($params);

        error_log("Update ID {$this->id} - Success: " . ($success ? 'Oui' : 'Non'));

        return $success;
    }

    public static function delete(string $id): bool
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("DELETE FROM user WHERE id = :id");

        return $stmt->execute([':id' => $id]);
    }

    private static function generateUuid(): string
    {
        $data = random_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
