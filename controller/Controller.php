<?php

class Controller
{
    protected $view;
    protected $session;
    public function __construct()
    {
        $this->view = new View();
        $this->session = new sessionController();
        $this->view->addGlobal('session', $this->session->getSession());

    }

    public function redirect($url)
    {

        header('Location: ' . $url);
        exit();
    }

};
