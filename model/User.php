<?php

require_once('model/Connect.php');

class User extends Connect {

	public function getUsers() {

		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM user');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;

	}



	public function getUser($userId) {

		$db = $this->dbConnect();
		$req = $db->prepare('SELECT user_id, last_name, first_name, login, email, password, active_account, role FROM user WHERE user_id = ?');
		$req->execute(array($userId));
		$user = $req->fetch(PDO::FETCH_ASSOC);

		return $user;
	}


	public function delete($userId) {
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM user WHERE user_id = ?');
		$req->execute(array($userId));
	}
}