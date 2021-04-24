<?php

namespace model;

use controller\sessionController;

class Connect
{

    protected $session;
    public function __construct()
    {

        $this->session = new sessionController();

    }
    protected function dbConnect()
    {
        $config=parse_ini_file("./conf/config.ini");
        // print_r($config);
        // exit();
        $dtb = new \PDO('mysql:host='.$config['server'].';dbname='.$config['dbname'].';charset=utf8', $config['user'], $config['password'], array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        return $dtb;
    }
}
