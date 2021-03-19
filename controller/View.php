<?php
class view
{
    private $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('views');
        $this->twig = new \Twig\Environment($loader);
    }

    public function show($page, $options)
    {
        echo $this->twig->render($page, $options);
    }

    public function addGlobal($key, $value)
    {
        $this->twig->addGlobal($key, $value);
    }

}