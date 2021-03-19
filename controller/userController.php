<?php

require_once 'model/User.php';
require_once 'controller/Controller.php';


class userController extends Controller
{
	public function login() {	
		
		$error ='';
		$success='';

		if(! empty($_POST)) {
			$user = new User();

			if($user->check($_POST['login'], $_POST['password'])) {
				
				

				
				if($this->session->getValue('role') == 'Administrator' || $this->session->getValue('role') == 'Author') {
					
					$this->redirect('/blog-mvc/Article/admin');
					$success = 'Vous êtes bien connecté !';
					
				}
				$this->redirect('/blog-mvc');
				$success = 'Vous êtes bien connecté !';
				
			}
			$error = 'Il y a une erreur dans le login ou le mot de passe !
			Avez-vous pensé à valider votre compte ?';
		}

		$this->view->show('login/login.php.twig', ['error' => $error, 'success' => $success]);

		

	}

	public function logout() {

		$this->session->reset();

		$this->redirect('/blog-mvc');

	}


	public function register() {
		
		$error = array();

		if(!empty($_POST)) {
			$user = new User();

			if(empty($_POST['nickname']) || !preg_match('/[a-zA-Z0-9_]+$/', $_POST['nickname'])) {

				$error = "Votre pseudo n'est pas valide ! Seuls les lettres minuscules et majuscules, les chiffres et le tiret underscore (_) sont autorisés.";
			} else {
				if($user->checkNickname($user)) {
				
					$error = "Ce pseudo est déjà utilisé !";
				}
			}

			if(empty($_POST['login']) || !filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) { 
			
				$error = "Votre e-mail n'est pas valide !";
			}
			if($user->checkLogin($user)) {
				
				$error = "Ce Login est déjà utilisé !";
			}

			if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {

				$error = "Vous devez saisir un mot de passe valide !";
			}

			if(empty($error)) {

				$user->createVisitor($_POST);

				$this->redirect('/blog-mvc/User/login');
			}
		}

		$this->view->show('register/register.php.twig', ['error' => $error]);
	}



	public function confirm($token) {


		$user = new User();
		$error = '';
		$success = '';

		if($user->checkToken($token)) {

			$success = 'Félicitations, votre compte a bien été validé !';

		} else {

			$error = "Une erreur s'est produite pendant la création de votre compte.";
		}

		$this->view->show('confirm/confirm.php.twig', ['user' => $user, 'error' => $error, 'success' => $success]);
	}



	public function list() {
		$user = new User();
		$users = $user->getUsers();

		if ($this->session->getValue('role') != 'Administrator') {
			$this->redirect('/blog-mvc');
		}

		$this->view->show('user/listUsers.php.twig', ['users' => $users, 'pageTitle' => 'Users']);
	}
	


	public function add($user) {

		if ($this->session->getValue('role') != 'Administrator') {
			$this->redirect('/blog-mvc');
		}

		$user = new User();
		
		if(!empty($_POST)) {
			$user->addUser($_POST);
			$this->redirect('/blog-mvc/User');
		}
		
		$this->view->show('user/addUser.php.twig', ['user' => $user, 'pageTitle' => 'Users']);

	}


	public function edit($userId) {

		if ($this->session->getValue('role') != 'Administrator') {
			$this->redirect('/blog-mvc');
		}

		$User = new User();
		$user = $User->getUser($userId);

		

		if(!empty($_POST)) {
			$User->editUser($_POST);
			$this->redirect('/blog-mvc/User');
		}
		$this->view->show('user/editUser.php.twig', ['user' => $user, 'pageTitle' => 'Users']);
		
	}

	public function delete($userId) {

		if ($this->session->getValue('role') != 'Administrator') {
			$this->redirect('/blog-mvc');
		}
		
		$User = new User();
		$User->delete($userId);

		

		$this->redirect('/blog-mvc/User');
	}
}



 ?>