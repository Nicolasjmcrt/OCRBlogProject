<?php

class Connect {

	protected function dbConnect() {

		$dtb = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $dtb;
	}
}