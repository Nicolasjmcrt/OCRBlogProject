<?php

ini_set('session.use_only_cookies',1);
ini_set('session.cookie_secure', 1);
ini_set("session.cookie_httponly", 1);
session_start();
require_once 'vendor/autoload.php';

use controller\router as router;
use controller\sessionController;
use controller\postController;
use controller\view;

// require_once 'controller/router.php';
// require_once 'controller/sessionController.php';
// require_once 'controller/postController.php';
// require_once 'controller/View.php';
$url ='';
if (isset($_GET['url'])) {
    $url = $_GET['url'];
}
$router = new router($url);
$router->run();

 ?>