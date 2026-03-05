<?php

use api\controller\UserController;
use api\controller\StoreController;

/**
 * Header
 */

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

/**
 * Autoload
 */

$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
        putenv(trim($line));
    }
}

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

spl_autoload_register(function ($class) {
    $prefix = 'api\\';

    $base_dir = __DIR__ . '/../src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

/**
 * Router
 */

$requestMethod = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = '/' . trim($path, '/');

/**
 * Auth
 */

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

/**
 * User
 */

if ($path === '/users' && $requestMethod === 'GET') {
    UserController::getAllUsers();
    exit;
}

if ($path === '/users' && $requestMethod === 'POST') {
    UserController::addUser();
    exit;
}

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

/**
 * Store
 */

if ($path === '/stores' && $requestMethod === 'GET') {
    StoreController::getAll();
    exit;
}

if ($path === '/stores' && $requestMethod === 'POST') {
    StoreController::create();
    exit;
}

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

http_response_code(404);
echo json_encode([
    'error' => 'Endpoint introuvable',
    'debug_path' => $path
]);
