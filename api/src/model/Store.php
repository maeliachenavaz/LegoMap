<?php

namespace api\model;

use api\config\Database;
use PDO;

class Store
{
    private string $id;
    private string $nom;
    private string $description;
    private string $date;
    private int $avis;
    private float $latitude;
    private float $longitude;
    private string $contactNom;
    private string $contactEmail;
    private string $photo;
    private string $creator_id;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getAvis(): int
    {
        return $this->avis;
    }

    public function setAvis(int $avis): void
    {
        $this->avis = $avis;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getContactNom(): string
    {
        return $this->contactNom;
    }

    public function setContactNom(string $contactNom): void
    {
        $this->contactNom = $contactNom;
    }

    public function getContactEmail(): string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(string $contactEmail): void
    {
        $this->contactEmail = $contactEmail;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    public function getCreator_id(): string
    {
        return $this->creator_id;
    }

    public function setCreator_id(string $creator_id): void
    {
        $this->creator_id = $creator_id;
    }

    public function toJson(): string
    {
        return json_encode([
            'id'            => $this->id,
            'nom'           => $this->nom,
            'description'   => $this->description,
            'date'          => $this->date,
            'avis'          => $this->avis,
            'latitude'      => $this->latitude,
            'longitude'     => $this->longitude,
            'contactNom'    => $this->contactNom,
            'contactEmail'  => $this->contactEmail,
            'photo'         => $this->photo,
            'creator_id'    => $this->creator_id,
        ]);
    }

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);

        if (!is_array($data)) {
            throw new \InvalidArgumentException('JSON invalide');
        }

        $store = new self();

        if (isset($data['id'])) {
            $store->setId($data['id']);
        }

        if (isset($data['nom'])) {
            $store->setNom($data['nom']);
        }

        if (isset($data['description'])) {
            $store->setDescription($data['description']);
        }

        if (isset($data['date'])) {
            $store->setDate($data['date']);
        }

        if (isset($data['avis'])) {
            $store->setAvis((int) $data['avis']);
        }

        if (isset($data['latitude'])) {
            $store->setLatitude((float) $data['latitude']);
        }

        if (isset($data['longitude'])) {
            $store->setLongitude((float) $data['longitude']);
        }

        if (isset($data['contactNom'])) {
            $store->setContactNom($data['contactNom']);
        }

        if (isset($data['contactEmail'])) {
            $store->setContactEmail($data['contactEmail']);
        }

        if (isset($data['photo'])) {
            $store->setPhoto($data['photo']);
        }

        if (isset($data['creator_id'])) {
            $store->setCreator_id($data['creator_id']);
        }

        return $store;
    }

    public function create(): ?string
    {
        $db = Database::getConnection();

        $this->id = self::generateUuid();

        $stmt = $db->prepare("
        INSERT INTO store (
            id, nom, description, date, avis,
            latitude, longitude,
            contact_nom, contact_email,
            photo, creator_id
        ) VALUES (
            :id, :nom, :description, :date, :avis,
            :latitude, :longitude,
            :contact_nom, :contact_email,
            :photo, :creator_id
        )
    ");

        $success = $stmt->execute([
            ':id'            => $this->id,
            ':nom'           => $this->nom,
            ':description'   => $this->description,
            ':date'          => $this->date,
            ':avis'          => $this->avis,
            ':latitude'      => $this->latitude,
            ':longitude'     => $this->longitude,
            ':contact_nom'   => $this->contactNom,
            ':contact_email' => $this->contactEmail,
            ':photo'         => $this->photo,
            ':creator_id'    => $this->creator_id,
        ]);

        return $success ? $this->id : null;
    }

    public static function getById(string $id): ?Store
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT * FROM store WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $store = new self();
        $store->setId($data['id']);
        $store->setNom($data['nom']);
        $store->setDescription($data['description']);
        $store->setDate($data['date']);
        $store->setAvis((int)$data['avis']);
        $store->setLatitude((float)$data['latitude']);
        $store->setLongitude((float)$data['longitude']);
        $store->setContactNom($data['contact_nom']);
        $store->setContactEmail($data['contact_email']);
        $store->setPhoto($data['photo']);
        $store->setCreator_id($data['creator_id']);

        return $store;
    }

    public static function getByCreatorId(string $creatorId): array
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT * FROM store WHERE creator_id = :creator_id");
        $stmt->execute([':creator_id' => $creatorId]);

        $stores = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $store = new self();
            $store->setId($data['id']);
            $store->setNom($data['nom']);
            $store->setDescription($data['description']);
            $store->setDate($data['date']);
            $store->setAvis((int)$data['avis']);
            $store->setLatitude((float)$data['latitude']);
            $store->setLongitude((float)$data['longitude']);
            $store->setContactNom($data['contact_nom']);
            $store->setContactEmail($data['contact_email']);
            $store->setPhoto($data['photo']);
            $store->setCreator_id($data['creator_id']);

            $stores[] = $store;
        }

        return $stores;
    }

    public static function getAll(): array
    {
        $db = Database::getConnection();

        $stmt = $db->query("SELECT * FROM store");

        $stores = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $store = new self();
            $store->setId($data['id']);
            $store->setNom($data['nom']);
            $store->setDescription($data['description']);
            $store->setDate($data['date']);
            $store->setAvis((int)$data['avis']);
            $store->setLatitude((float)$data['latitude']);
            $store->setLongitude((float)$data['longitude']);
            $store->setContactNom($data['contact_nom']);
            $store->setContactEmail($data['contact_email']);
            $store->setPhoto($data['photo']);
            $store->setCreator_id($data['creator_id']);

            $stores[] = $store;
        }

        return $stores;
    }

    public function update(): bool
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("
        UPDATE store SET 
            nom = :nom, 
            description = :description, 
            date = :date, 
            avis = :avis, 
            latitude = :latitude, 
            longitude = :longitude, 
            contact_nom = :contact_nom, 
            contact_email = :contact_email, 
            photo = :photo 
        WHERE id = :id
    ");

        $params = [
            ':id'            => $this->id,
            ':nom'           => $this->nom,
            ':description'   => $this->description,
            ':date'          => $this->date,
            ':avis'          => $this->avis,
            ':latitude'      => $this->latitude,
            ':longitude'     => $this->longitude,
            ':contact_nom'   => $this->contactNom,
            ':contact_email' => $this->contactEmail,
            ':photo'         => $this->photo,
        ];

        $success = $stmt->execute($params);

        error_log("Update ID {$this->id} - Success: " . ($success ? 'Oui' : 'Non'));

        return $success; // On retourne directement la variable, on ne ré-exécute pas !
    }

    public static function delete(string $id): bool
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("DELETE FROM store WHERE id = :id");

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
