<?php

require_once 'model/Connect.php';

class User extends Connect {

	public function getUsers() {

		$dtb = $this->dbConnect();
		$req = $dtb->query('SELECT * FROM user ORDER BY user_id DESC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;

	}



	public function getInvalidCommentsNickname($commentId) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('SELECT comment.*, user.* FROM user INNER JOIN comment ON user.user_id=comment.user_id WHERE comment_id=?');
		$req->execute(array($commentId));
		$user = $req->fetch(PDO::FETCH_ASSOC);

		return $user;
	}



	public function getUser($userId) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('SELECT * FROM user WHERE user_id = ?');
		$req->execute(array($userId));
		$user = $req->fetch(PDO::FETCH_ASSOC);

		return $user;
	}

	public function getAuthor($articleId) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare("SELECT user_id, first_name FROM user WHERE role = 'Administrator' OR role = 'Author' ORDER BY user_id ASC");
		$req->execute(array($articleId));
		$user = $req->fetchAll(PDO::FETCH_ASSOC);

		return $user;
	}

	public function check($user, $password) {
		$dtb = $this->dbConnect();
		$req = $dtb->prepare('SELECT * FROM user WHERE login=? AND active_account=1');
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

			$_SESSION['role'] = $user['role'];
			$_SESSION['user_id'] = $user['user_id'];
			$_SESSION['nickname'] = $user['nickname'];
			$_SESSION['first_name'] = $user['first_name'];
			$_SESSION['last_name'] = $user['last_name'];


			return true;
		}

		return false;
	}



	public function createVisitor($user) {
		$token = bin2hex(random_bytes(78));
		$dtb = $this->dbConnect();
		$req = $dtb->prepare("INSERT INTO user SET nickname = ?, login = ?, password = ?, role = 'Visitor', active_account = 0, token = ?, token_date = ?");

		$password = password_hash($user['password'], PASSWORD_BCRYPT);

		$req->execute(array($user['nickname'], $user['login'], $password, $token, date('Y-m-d H:i:s')));

		$user_id = $dtb->lastInsertId();


		mail($user['email'], 'Veuillez confirmer votre adresse e-mail', "Bonjour, Cliquez sur le lien ci-desous pour confirmer votre adresse e-mail. Cette manipulation permet de vérifier que vous en êtes le propriétaire.\n\nhttp://localhost:8888/blog-mvc/user/confirm/?id=$user_id&token=$token");

	}



	public function checkNickname($user) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('SELECT user_id FROM user WHERE nickname = ?');
		$req->execute([$user['nickname']]);
		return $req->fetch();
	}




	public function checkLogin($user) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('SELECT user_id FROM user WHERE login = ?');
		$req->execute([$_POST['login']]);
		return $req->fetch();

	}



	public function checkToken($token) {

		$date = new DateTime();

		$date->modify('-7 days');

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('SELECT * FROM user WHERE token = ? AND token_date >= ?');
		$req->execute(array($token, $date->format('Y-m-d H:i:s')));
		$check = $req->fetch(PDO::FETCH_ASSOC);

		if(!$check) {
			return false;
		} else {

			$req = $dtb->prepare('UPDATE user SET active_account = 1, token = NULL WHERE token = ?');
			$req->execute(array($token));

		return true;
		}

	}


	public function addUser($user) {

		$token = bin2hex(random_bytes(78));

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('INSERT INTO user SET first_name=?, last_name=?, nickname=?, login=?, email=?, password=?, role=?, active_account=?');
		$password = password_hash($user['password'], PASSWORD_BCRYPT);

		$req->execute(array($user['firstname'], $user['lastname'], $user['nickname'], $user['login'], $user['email'], $password, $user['role'], $user['activeaccount']));
	}



	public function editUser($user) {
		
		$dtb = $this->dbConnect();
		$req = $dtb->prepare('UPDATE user SET first_name=?, last_name=?, login=?, email=?, role=?, active_account=? WHERE user_id=?');
		$req->execute(array($user['firstname'], $user['lastname'], $user['login'], $user['email'], $user['role'], $user['activeaccount'], $user['userId']));

		if(isset($user['nickname'])) {
			$req = $dtb->prepare('UPDATE user SET nickname=? WHERE user_id=?');
			$req->execute(array($user['nickname'], $user['userId']));
		}

		if(isset($user['password']) && !empty($user['password'])) {
			$req = $dtb->prepare('UPDATE user SET password=? WHERE user_id=?');
			$req->execute(array(password_hash($user['password'], PASSWORD_BCRYPT), $user['userId']));
		}
	}



	public function delete($userId) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('DELETE FROM user WHERE user_id = ?');
		$req->execute(array($userId));
	}
}