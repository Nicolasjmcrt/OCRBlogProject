<?php

class Controller
{
    protected $twig;

    public function __construct()
    {
       $loader = new \Twig\Loader\FilesystemLoader('views');
       $this->twig = new \Twig\Environment($loader);
       $this->twig->addGlobal('session', sessionController::getSession());

        
    }

    public function redirect($url) {

        header('Location: '.$url);
        exit();
    }
    
};


