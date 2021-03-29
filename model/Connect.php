<?php

namespace model;

class Connect
{

    protected $session;
    public function __construct()
    {

        $this->session = new sessionController();

    }
    protected function dbConnect()
    {

        $dtb = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $dtb;
    }
}
