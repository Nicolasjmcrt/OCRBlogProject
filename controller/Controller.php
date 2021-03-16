<?php

class Controller
{
    protected $twig;
    protected $session;
    public function __construct()
    {
       $loader = new \Twig\Loader\FilesystemLoader('views');
       $this->twig = new \Twig\Environment($loader);
       $this->session = new sessionController();
       $this->twig->addGlobal('session', $this->session->getSession());

        
    }

    public function redirect($url) {

        header('Location: '.$url);
        exit();
    }
    
};


