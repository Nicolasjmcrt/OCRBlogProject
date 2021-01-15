<?php
ini_set('session.use_only_cookies',1);
ini_set("session.cookie_httponly", 1);
session_name('Administration-Blog-CoyoTech');
session_cache_expire(15);
session_start();
session_regenerate_id();


if(empty($_SESSION['connecte'])){
	header("Location: login.php");
	echo'<html><head><title>ERROR</title></head><body><p style="text-align:center;font-size:36px;margin-top:40px;"><b>Acc&egrave;s r&eacute;fus&eacute;</b></body></html>';
	exit();
}


?>
