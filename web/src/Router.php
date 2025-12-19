<?php

namespace App;

use App\Controller\HomeController;

class Router
{
    public function dispatch(string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        switch ($path) {
            case '/':
                (new HomeController())->index();
                break;

            default:
                http_response_code(404);
                echo 'Page non trouvée';
        }
    }
}
