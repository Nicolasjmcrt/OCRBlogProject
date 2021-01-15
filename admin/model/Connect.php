<?php

/*paramètres pour connection à la base de données*/
error_reporting(1);



try{
	$bdd=new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
}
catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

?>