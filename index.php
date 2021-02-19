<?php
session_start();

require_once ('vendor/autoload.php');

require_once ('controller/router.php');
$url ='';
if (isset($_GET['url'])) {
    $url = $_GET['url'];
}
$router = new router($url);
$router->run();

 ?>