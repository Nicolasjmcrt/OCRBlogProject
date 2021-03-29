<?php

namespace controller;

class Controller
{
    protected $view;
    protected $session;
    protected $post;
    public function __construct()
    {
        $this->view = new View();
        $this->session = new sessionController();
        $this->view->addGlobal('session', $this->session->getSession());
        $this->post = new postController();

    }

    public function redirect($url)
    {

        header('Location: ' . $url);
        exit();
    }

};
