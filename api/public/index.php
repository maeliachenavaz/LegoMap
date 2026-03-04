<?php
// =================================================================
// 1. CONFIGURATION & HEADERS
// =================================================================
// ================= CORS CLEAN =================
header("Access-Control-Allow-Origin: http://localhost:8000");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

session_start();

// Dans api/public/index.php

$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
        putenv(trim($line)); // Optionnel, pour plus de compatibilité
    }
}

// =================================================================
// 2. AUTOLOADING
// =================================================================

// A. Si tu utilises Composer pour des libs externes (JWT, etc.)
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

// B. Autoloader personnalisé pour tes classes dans /src
// Mappe le namespace "api\" vers le dossier "../src/"
spl_autoload_register(function ($class) {
    // Préfixe de namespace à chercher
    $prefix = 'api\\';

    // Dossier de base pour ce préfixe (on remonte de public vers src)
    $base_dir = __DIR__ . '/../src/';

    // Vérifie si la classe utilise ce préfixe
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return; // Ce n'est pas une classe de notre projet
    }

    // Récupère le nom relatif de la classe (ex: controller\UserController)
    $relative_class = substr($class, $len);

    // Remplace les backslashs par des slashs de dossier
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Si le fichier existe, on le charge
    if (file_exists($file)) {
        require $file;
    }
});

use api\controller\UserController;
use api\controller\StoreController;

// =================================================================
// 3. ROUTEUR (Version Corrigée pour localhost:8001)
// =================================================================

$requestMethod = $_SERVER['REQUEST_METHOD'];
// On récupère uniquement le chemin de l'URL (ex: /login)
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Nettoyage : On s'assure que ça commence par / et qu'il n'y a pas de / à la fin
// Sauf si c'est juste la racine "/"
$path = '/' . trim($path, '/');

// --- DEBUG : Décommente la ligne suivante si tu as encore des soucis ---
// error_log("Méthode: $requestMethod | Path: $path");


// --- ROUTES AUTHENTIFICATION ---

// Note : On compare avec '/login' (avec le slash au début)
if ($path === '/login' && $requestMethod === 'POST') {
    UserController::login();
    exit;
}

if ($path === '/register' && $requestMethod === 'POST') {
    UserController::register();
    exit;
}

if ($path === '/logout' && $requestMethod === 'POST') {
    UserController::logout();
    exit;
}

if ($path === '/users' && $requestMethod === 'GET') {
    UserController::getAllUsers(); // On va créer cette méthode
    exit;
}

if ($path === '/users' && $requestMethod === 'POST') {
    UserController::addUser(); // On appelle la nouvelle méthode
    exit;
}

// --- ROUTES STORES ---

// 1. Liste de tous les stores
if ($path === '/stores' && $requestMethod === 'GET') {
    StoreController::getAll();
    exit;
}

// 2. Création d'un store
if ($path === '/stores' && $requestMethod === 'POST') {
    StoreController::create();
    exit;
}

// 3. Stores de l'utilisateur (AVANT la route /{id} sinon "user" sera pris pour un ID)
if ($path === '/stores/user' && $requestMethod === 'GET') {
    StoreController::getByUser();
    exit;
}

if (preg_match('#^/stores/preview/([\w-]+)$#', $path, $matches)) {
    $id = $matches[1];
    if ($requestMethod === 'GET') {
        StoreController::getStorePreview($id);
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
    }
    exit;
}

// 4. Opérations sur un store spécifique (ID)
if (preg_match('#^/stores/([\w-]+)$#', $path, $matches)) {
    $id = $matches[1];
    switch ($requestMethod) {
        case 'GET':    StoreController::getStore($id); break;
        case 'PUT':    StoreController::update($id); break;
        case 'DELETE': StoreController::delete($id); break;
        default:       http_response_code(405); echo json_encode(['error' => 'Method Not Allowed']); break;
    }
    exit;
}


// --- ROUTES USERS ---
if (preg_match('#^/users/([\w-]+)$#', $path, $matches)) {
    $id = $matches[1];
    switch ($requestMethod) {
        case 'GET':    UserController::getUser($id); break;
        case 'PUT':    UserController::updateUser($id); break;
        case 'DELETE': UserController::deleteUser($id); break;
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
            break;
    }
    exit;
}


// --- 404 NOT FOUND ---
http_response_code(404);
echo json_encode([
    'error' => 'Endpoint introuvable',
    'debug_path' => $path // Utile pour voir ce que le routeur a compris
]);