<?php

class Controller
{
    protected $twig;

    public function __construct()
    {
       $loader = new \Twig\Loader\FilesystemLoader('views');
       $this->twig = new \Twig\Environment($loader);

        // $this->twig->addGlobal('_session', $_SESSION);
        $this->twig->addGlobal('_post', $_POST);
        $this->twig->addGlobal('_get', $_GET);
    }
};
