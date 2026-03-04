<?php

namespace api\controller;

use api\model\Store;
use api\service\AuthService;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class StoreController
{
    /* =========================
       REVERSE GEOCODING : récupère la ville depuis lat/lon
    ========================== */
    private static function getCityFromCoordinates(float $lat, float $lon): ?string
    {
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lon}&zoom=10&addressdetails=1";
        $options = [
            "http" => [
                "header" => "User-Agent: lego-app\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = @file_get_contents($url, false, $context);

        if (!$response) return null;

        $data = json_decode($response, true);

        return $data['address']['city']
            ?? $data['address']['town']
            ?? $data['address']['village']
            ?? null;
    }

    public static function create(): void
    {
        $auth = AuthService::checkAndRefresh();
        $userId = $auth['user_id'];

        $data = $_POST;

        if (empty($data)) {
            $data = json_decode(file_get_contents('php://input'), true) ?? [];
        }

        $required = ['nom', 'description', 'date', 'avis', 'latitude', 'longitude', 'contactNom', 'contactEmail'];

        foreach ($required as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                http_response_code(400);
                echo json_encode(['error' => "Paramètre manquant : $field"]);
                return;
            }
        }

        // 4. Gestion de la Photo (Fichier)
        $photoBase64 = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $type = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $data_img = file_get_contents($_FILES['photo']['tmp_name']);
            $photoBase64 = base64_encode($data_img);
        }

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
            self::sendStoreCreatedEmail($store);
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

    public static function getStorePreview(string $id): void
    {
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

        // On récupère "page" depuis les paramètres GET (null si absent)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : null;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 1000; // Optionnel : permettre de changer la taille du lot

        // On appelle le modèle avec les paramètres
        $stores = Store::getAll($page, $limit);

        $result = [];
        foreach ($stores as $store) {
            $arr = json_decode($store->toJson(), true);

            // Optimisation : n'appeler Nominatim que si nécessaire
            // (Note: faire du reverse geocoding sur chaque élément d'une liste peut ralentir l'API)
            if (empty($arr['ville'])) {
                $arr['ville'] = self::getCityFromCoordinates($arr['latitude'], $arr['longitude']);
            }
            $result[] = $arr;
        }

        http_response_code(200);
        echo json_encode($result);
    }

    public static function getByUser(): void
    {
        $auth = AuthService::checkAndRefresh();
        $userId = $auth['user_id'];

        // Récupération des paramètres de pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : null;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 1000;

        // Appel du modèle avec pagination
        $stores = Store::getByCreatorId($userId, $page, $limit);

        $result = [];
        foreach ($stores as $store) {
            $arr = json_decode($store->toJson(), true);
            if (empty($arr['ville'])) {
                $arr['ville'] = self::getCityFromCoordinates($arr['latitude'], $arr['longitude']);
            }
            $result[] = $arr;
        }

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

        if ($store->getCreator_id() !== $userId) {
            http_response_code(403);
            echo json_encode(['error' => 'Accès interdit']);
            return;
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        error_log('Contenu brut reçu: ' . $json);
        error_log('Data décodée: ' . print_r($data, true));

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
            echo $store->toJson(); // Pas besoin de re-requêter la DB ici
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

    private static function sendStoreCreatedEmail(Store $store): void
    {
        $mail = new PHPMailer(true);

        // --- REVERSE GEOCODING ---
        $lat = $store->getLatitude();
        $lon = $store->getLongitude();
        $fullAddress = "Adresse non disponible";

        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lon}&zoom=18&addressdetails=1";
        $options = ["http" => ["header" => "User-Agent: LegoMapApp/1.0\r\n"]];
        $context = stream_context_create($options);
        $response = @file_get_contents($url, false, $context);

        if ($response) {
            $data = json_decode($response, true);
            $fullAddress = $data['display_name'] ?? $fullAddress;
        }

        try {
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '9e3692aead233b';
            $mail->Password = '6e84e0077f8f4d';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Expéditeur / destinataire
            $mail->setFrom('no-reply@lego-app.com', 'Lego App');
            $mail->addAddress('maelia.chenavaz@viacesi.fr', $store->getContactNom());

            $templatePath = __DIR__ . '/mail/nouveau_store.html';

            if (!file_exists($templatePath)) {
                error_log("Template introuvable : " . $templatePath);
                $message = "LEGO Map - Nouveau store créé : " . $store->getNom();
            } else {
                $message = file_get_contents($templatePath);

                // Remplacement des placeholders
                $placeholders = [
                    '{{id}}'          => $store->getId(),
                    '{{nom}}'          => $store->getNom(),
                    '{{description}}'  => $store->getDescription(),
                    '{{date}}'         => $store->getDate(),
                    '{{avis}}'         => $store->getAvis(),
                    '{{contactNom}}'   => $store->getContactNom(),
                    '{{contactEmail}}' => $store->getContactEmail(),
                    '{{adresse}}'     => $fullAddress
                ];

                $message = str_replace(array_keys($placeholders), array_values($placeholders), $message);
            }

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->Subject = 'LEGO Map - Nouveau store créé : ' . $store->getNom();
            $mail->Body    = $message;
            $mail->AltBody = "LEGO Map - Nouveau store créé : {$store->getNom()}";

            $mail->send();
        } catch (Exception $e) {
            error_log("Erreur envoi mail Mailtrap : " . $mail->ErrorInfo);
        }
    }
}