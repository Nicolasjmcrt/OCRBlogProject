<?php

require_once('model/Connect.php');

class User extends Connect {

	public function getUsers() {

		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM user ORDER BY user_id DESC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;

	}

	public function getInvalidCommentsNickname($commentId) {

		$db = $this->dbConnect();
		$req = $db->prepare('SELECT comment.*, user.* FROM user INNER JOIN comment ON user.user_id=comment.user_id WHERE comment_id=?');
		$req->execute(array($commentId));
		$user = $req->fetch(PDO::FETCH_ASSOC);

		return $user;
	}

	public function getUser($userId) {

		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM user WHERE user_id = ?');
		$req->execute(array($userId));
		$user = $req->fetch(PDO::FETCH_ASSOC);

		return $user;
	}


	public function delete($userId) {
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM user WHERE user_id = ?');
		$req->execute(array($userId));
	}



	public function check($user, $password) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM user WHERE login=? AND active_account=1');
		$req->execute(array($user));
		$user = $req->fetch(PDO::FETCH_ASSOC);
		if(!$user) {
			return false;
		}
	
		$check = password_verify($password, $user['password']);
		if(password_needs_rehash($user['password'], PASSWORD_BCRYPT)) {
			$password = password_hash($user['password'], PASSWORD_BCRYPT);
			$req=$db->prepare('UPDATE user SET password=? WHERE user_id=?');
			$req->execute(array($password, $user['user_id']));
		}

		if($check) {
			return true;
		}

		return false;
	}

	public function createVisitor($user) {
		$token = bin2hex(random_bytes(78));
		$db = $this->dbConnect();
		$req = $db->prepare("INSERT INTO user SET nickname = ?, login = ?, password = ?, role = 'Visitor', active_account = 0, token = ?, token_date = ?");

		$password = password_hash($user['password'], PASSWORD_BCRYPT);

		$req->execute(array($user['nickname'], $user['login'], $password, $token, date('Y-m-d H:i:s')));
		
	}

	public function checkToken($token) {

		$date = new DateTime();

		$date->modify('-7 days');

		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM user WHERE token = ? AND token_date >= ?');
		$req->execute(array($token, $date->format('Y-m-d H:i:s')));
		$check = $req->fetch(PDO::FETCH_ASSOC);

		if(!$check) {
			return false;
		}

		// Quand compte confirmé, mettre à NULL champ token et champ active_account
		return true;
	}

	public function editUser($user) {
		
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE user SET first_name=?, last_name=?, login=?, email=?, role=?, active_account=? WHERE user_id=?');
		$req->execute(array($user['firstname'], $user['lastname'], $user['login'], $user['email'], $user['role'], $user['activeaccount'], $user['userId']));

		if(isset($user['nickname'])) {
			$req = $db->prepare('UPDATE user SET nickname=? WHERE user_id=?');
			$req->execute(array($user['nickname'], $user['userId']));
		}

		if(isset($user['password']) && !empty($user['password'])) {
			$req = $db->prepare('UPDATE user SET password=? WHERE user_id=?');
			$req->execute(array(password_hash($user['password'], PASSWORD_BCRYPT), $user['userId']));
		}
	}
}