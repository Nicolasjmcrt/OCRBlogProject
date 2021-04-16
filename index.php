<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
ini_set("session.cookie_httponly", 1);
session_start();
require_once 'vendor/autoload.php';

use controller\router;

$url = '';
if (isset($_GET['url'])) {
    $url = $_GET['url'];
}
$router = new router($url);
$router->run();
