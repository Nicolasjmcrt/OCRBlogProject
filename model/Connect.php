<?php

class Connect {

	protected function dbConnect() {

		$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
		return $db;
	}
}