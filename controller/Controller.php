<?php

class Controller
{
    protected $twig;

    public function __construct()
    {
       $loader = new \Twig\Loader\FilesystemLoader('views');
       $this->twig = new \Twig\Environment($loader);
       $session = new sessionControler();
       $this->twig->addGlobal('session', $session->getSession());

        
    }

    public function redirect($url) {

        header('Location: '.$url);
        exit();
    }
    
};


