<?php

namespace controller;

use controller\Controller;
use model\User;

class userController extends Controller
{
    /**
     * gestion de connexion des utilisateurs
     *
     * @return void
     */
    public function login()
    {

        $error = '';
        $message = $this->session->getValue('message');
        $_SESSION['message'] = "";

        if (!empty($this->post->getPost())) {
            $user = new User();

            if ($user->check($this->post->getValue('login'), $this->post->getValue('password'))) {

                if ($this->session->getValue('role') == 'Administrator' || $this->session->getValue('role') == 'Author') {

                    $_SESSION['message'] = "Vous êtes bien connecté !";
                    $this->redirect('/blog-mvc/article/admin');

                }
                $_SESSION['message'] = "Vous êtes bien connecté !";
                $this->redirect('/blog-mvc');

            }
            $error = 'Il y a une erreur dans le login ou le mot de passe !
			Avez-vous pensé à valider votre compte ?';
        }

        $this->view->show('login/login.php.twig', ['error' => $error, 'message' => $message]);
    }

    /**
     * gestion de déconnexion des utilisateurs
     *
     * @return void
     */
    public function logout()
    {

        $this->session->reset();

        $this->redirect('/blog-mvc');
    }

    /**
     * gestion de l'inscription des utilisateurs
     *
     * @return void
     */
    public function register()
    {

        $error = array();

        if (!empty($this->post->getPost())) {
            $user = new User();

            if (empty($this->post->getValue('nickname')) || !preg_match('/[a-zA-Z0-9_]+$/', $this->post->getValue('nickname'))) {

                $error = "Votre pseudo n'est pas valide ! Seuls les lettres minuscules et majuscules, les chiffres et le tiret underscore (_) sont autorisés.";
            } else {
                if ($user->checkNickname($user)) {

                    $error = "Ce pseudo est déjà utilisé !";
                }
            }

            if (empty($this->post->getValue('login')) || !filter_var($this->post->getValue('login'), FILTER_VALIDATE_EMAIL)) {

                $error = "Votre e-mail n'est pas valide !";
            }
            if ($user->checkLogin($user)) {

                $error = "Ce Login est déjà utilisé !";
            }

            if (empty($this->post->getValue('password')) || $this->post->getValue('password') != $this->post->getValue('password_confirm')) {

                $error = "Vous devez saisir un mot de passe valide !";
            }

            if (empty($error)) {

                $user->createVisitor($this->post->getPost());

                $_SESSION['message'] = "Votre compte a bien été réservé. Vous recevrez bientôt un mail de confirmation. Dans le cas contraire, contactez-nous via le formulaire en page d'accueil.";
                $this->redirect('/blog-mvc/user/login');
            }
        }

        $this->view->show('register/register.php.twig', ['error' => $error]);
    }

    /**
     * gestion de la validation des comptes utilisateurs
     *
     * @param  mixed $token
     * @return void
     */
    public function confirm($token)
    {

        $user = new User();
        $error = '';
        $success = '';

        if ($user->checkToken($token)) {

            $success = 'Félicitations, votre compte a bien été validé !';
        } else {

            $error = "Une erreur s'est produite pendant la création de votre compte.";
        }

        $this->view->show('confirm/confirm.php.twig', ['user' => $user, 'error' => $error, 'success' => $success]);
    }

    /**
     * affichage de la liste des utilisateurs (Back-end)
     *
     * @return void
     */
    function list() {
        $user = new User();
        $users = $user->getUsers();
        $_SESSION['message'] ="";

        if ($this->session->getValue('role') != 'Administrator') {
            $this->redirect('/blog-mvc');
        }
        $message = $this->session->getValue('message');
        $this->view->show('user/listUsers.php.twig', ['users' => $users, 'pageTitle' => 'Users', 'message' => $message]);
    }

    /**
     * fonction d'ajout d'un utilisateur avec création d'un id
     *
     * @param  int $user
     * @return void
     */
    public function add($user)
    {

        if ($this->session->getValue('role') != 'Administrator') {
            $this->redirect('/blog-mvc');
        }

        $user = new User();

        if (!empty($this->post->getPost())) {
            $user->addUser($this->post->getPost());
            $_SESSION['message'] = "Le nouvel utilisateur a bien été ajouté !";
            $this->redirect('/blog-mvc/user');
        }

        $this->view->show('user/addUser.php.twig', ['user' => $user, 'pageTitle' => 'Users']);
    }

    /**
     * fonction de modification d'un utilisateur à l'aide de son id
     *
     * @param  int $userId
     * @return void
     */
    public function edit(int $userId)
    {

        if ($this->session->getValue('role') != 'Administrator') {
            $this->redirect('/blog-mvc');
        }

        $User = new User();
        $user = $User->getUser($userId);

        if (!empty($this->post->getPost())) {
            $User->editUser($this->post->getPost());
            $this->redirect('/blog-mvc/user');
        }
        $this->view->show('user/editUser.php.twig', ['user' => $user, 'pageTitle' => 'Users']);
    }

    /**
     * fonction de suppression d'un utilisateur à l'aide de son id
     *
     * @param  int $userId
     * @return void
     */
    public function delete(int $userId)
    {

        if ($this->session->getValue('role') != 'Administrator') {
            $this->redirect('/blog-mvc');
        }

        $User = new User();
        $User->delete($userId);

        $this->redirect('/blog-mvc/user');
    }
}
