<?php

namespace api\controller;

use api\model\Store;
use api\service\AuthService;

class StoreController
{
    public static function create(): void
    {
        $auth = AuthService::checkAndRefresh();
        $userId = $auth['user_id'];

        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['nom'], $data['description'], $data['date'], $data['avis'], $data['latitude'], $data['longitude'], $data['contactNom'], $data['contactEmail'], $data['photo'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Paramètres manquants']);
            return;
        }

        $store = new Store();
        $store->setNom($data['nom']);
        $store->setDescription($data['description']);
        $store->setDate($data['date']);
        $store->setAvis((int)$data['avis']);
        $store->setLatitude((float)$data['latitude']);
        $store->setLongitude((float)$data['longitude']);
        $store->setContactNom($data['contactNom']);
        $store->setContactEmail($data['contactEmail']);
        $store->setPhoto($data['photo']);
        $store->setCreator_id($userId);

        $id = $store->create();

        if ($id) {
            http_response_code(201);
            echo $store->toJson();
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de la création du store']);
        }
    }

    public static function getStore(string $id): void
    {
        AuthService::checkAndRefresh();

        $store = Store::getById($id);

        if (!$store) {
            http_response_code(404);
            echo json_encode(['error' => 'Store non trouvé']);
            return;
        }

        http_response_code(200);
        echo $store->toJson();
    }

    public static function getAll(): void
    {
        AuthService::checkAndRefresh();

        $stores = Store::getAll();
        $result = array_map(fn($store) => json_decode($store->toJson(), true), $stores);

        http_response_code(200);
        echo json_encode($result);
    }

    public static function getByUser(): void
    {
        $auth = AuthService::checkAndRefresh();
        $userId = $auth['user_id'];

        $stores = Store::getByCreatorId($userId);
        $result = array_map(fn($store) => json_decode($store->toJson(), true), $stores);

        http_response_code(200);
        echo json_encode($result);
    }

    /* =========================
       UPDATE STORE
    ==========================*/
    public static function update(string $id): void
    {
        $auth = AuthService::checkAndRefresh();
        $userId = $auth['user_id'];

        $store = Store::getById($id);

        if (!$store) {
            http_response_code(404);
            echo json_encode(['error' => 'Store non trouvé']);
            return;
        }

        // Seul le créateur peut modifier
        if ($store->getCreator_id() !== $userId) {
            http_response_code(403);
            echo json_encode(['error' => 'Accès interdit']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['nom'])) $store->setNom($data['nom']);
        if (isset($data['description'])) $store->setDescription($data['description']);
        if (isset($data['date'])) $store->setDate($data['date']);
        if (isset($data['avis'])) $store->setAvis((int)$data['avis']);
        if (isset($data['latitude'])) $store->setLatitude((float)$data['latitude']);
        if (isset($data['longitude'])) $store->setLongitude((float)$data['longitude']);
        if (isset($data['contactNom'])) $store->setContactNom($data['contactNom']);
        if (isset($data['contactEmail'])) $store->setContactEmail($data['contactEmail']);
        if (isset($data['photo'])) $store->setPhoto($data['photo']);

        if ($store->update()) {
            http_response_code(200);
            echo $store->toJson();
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de la mise à jour']);
        }
    }

    /* =========================
       DELETE STORE
    ==========================*/
    public static function delete(string $id): void
    {
        $auth = AuthService::checkAndRefresh();
        $userId = $auth['user_id'];

        $store = Store::getById($id);

        if (!$store) {
            http_response_code(404);
            echo json_encode(['error' => 'Store non trouvé']);
            return;
        }

        // Seul le créateur peut supprimer
        if ($store->getCreator_id() !== $userId) {
            http_response_code(403);
            echo json_encode(['error' => 'Accès interdit']);
            return;
        }

        if (Store::delete($id)) {
            http_response_code(200);
            echo json_encode(['message' => 'Store supprimé']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de la suppression']);
        }
    }
}
