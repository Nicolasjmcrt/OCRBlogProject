<?php

require_once ('model/User.php');
require_once ('controller/Controller.php');


class userController extends Controller
{
	public function login()
	{
		print_r($_POST);
		require_once('login.php');

	}

	public function logout()
	{
		echo 'logout';
	}

	public function register()
	{
		echo 'register';
	}

	public function list() {
		$user = new User();
		$users = $user->getUsers();

		echo $this->twig->render('user/listUsers.php.twig', ['users' => $users]);
	}


	public function view($userId) {
		$user = new User();

		echo '<pre>';
		print_r($user->getUser($userId));
	}

	public function delete($userId) {
		$user = new User();

		$user->delete($userId);
	}
}



 ?>