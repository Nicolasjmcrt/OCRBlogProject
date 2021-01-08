<?php

require_once ('controller/router.php');
$router = new router($_GET['url']);
$router->run();

 ?>