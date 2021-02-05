<?php

require_once ('model/User.php');
require_once ('controller/Controller.php');


class userController extends Controller
{
	public function login() {	
		
		$error ='';

		if(! empty($_POST)) {
			$user = new User();

			if($user->check($_POST['login'], $_POST['password'])) {
				
				header('Location: /blog-mvc');
				
			}
			$error = 'Il y a une erreur dans le login ou le mot de passe !';
		}

		echo $this->twig->render('login/login.php.twig', ['error' => $error]);

	}

	public function logout() {
		echo 'logout';
	}


	public function register() {
		
		$error = array();

		if(!empty($_POST)) {
			$user = new User();

			if(empty($_POST['nickname']) || !preg_match('/[a-zA-Z0-9_]+$/', $_POST['nickname'])) {

				$error = "Votre pseudo n'est pas valide ! Seuls les lettres minuscules et majuscules, les chiffres et le tiret underscore (_) sont autorisés.";
			}

			if(empty($_POST['login']) || !filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {

				$error = "Votre e-mail n'est pas valide !";
			}

			if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {

				$error = "Vous devez saisir un mot de passe valide !";
			}

			if(empty($error)) {

				$user->createVisitor($_POST);
				header('Location: /blog-mvc');
			}
		}

		

		echo $this->twig->render('register/register.php.twig', ['error' => $error]);
	}

	public function confirm($token) {


		$user = new User();

		if($user->checkToken($token)) {

			echo 'ok';
		}
		exit();
	}

	public function list() {
		$user = new User();
		$users = $user->getUsers();

		echo $this->twig->render('user/listUsers.php.twig', ['users' => $users, 'pageTitle' => 'Users']);
	}
	
	public function edit($userId) {
		$User = new User();
		$user = $User->getUser($userId);

		if(!empty($_POST)) {
			$User->editUser($_POST);
			header('Location: /blog-mvc/User');
		}
		echo $this->twig->render('user/editUser.php.twig', ['user' => $user, 'pageTitle' => 'Users']);
		
	}

	public function delete($userId) {
		$User = new User();
		$User->delete($userId);

		header('Location: /blog-mvc/User');
	}
}



 ?>