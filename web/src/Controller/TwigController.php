<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class TwigController
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $this->twig = new Environment($loader, [
            'cache' => $_SERVER['DOCUMENT_ROOT'].'/../var/cache'
            ,'debug' => true
        ]);
        $this->twig->addExtension(new DebugExtension());

        $fileExist = new TwigFunction('file_exists', function($fullFileName){
            return file_exists($fullFileName);
        });
        $this->twig->addFunction($fileExist);

        $this->twig->addGlobal('session', $_SESSION);
    }
}
