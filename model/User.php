<?php

namespace model;

use model\Connect;

class User extends Connect
{

    /**
     * requete en base de données pour affichage des utilisateurs (Back-end)
     *
     * @return void
     */
    public function getUsers()
    {

        $dtb = $this->dbConnect();
        $req = $dtb->query('SELECT * FROM user ORDER BY user_id DESC');
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * requete en base de données pour affichage les auteurs des commentaires non validés en fonction de l'id du commentaire (Back-end)
     *
     * @param  int $commentId
     * @return array
     */
    public function getInvalidCommentsNickname(int $commentId)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('SELECT comment.*, user.* FROM user INNER JOIN comment ON user.user_id=comment.user_id WHERE comment_id=?');
        $req->execute(array($commentId));
        $user = $req->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    /**
     * requete en base de données pour affichage un utilisateur en fonction de son id (Back-end)
     *
     * @param  int $userId
     * @return array
     */
    public function getUser(int $userId)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('SELECT * FROM user WHERE user_id = ?');
        $req->execute(array($userId));
        $user = $req->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    /**
     * requete en base de données pour affichage l'auteur d'un article (Back-end)
     *
     * @param  mixed $articleId
     * @return array
     */
    public function getAuthor($articleId)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare("SELECT user_id, first_name FROM user WHERE role = 'Administrator' OR role = 'Author' ORDER BY user_id ASC");
        $req->execute(array($articleId));
        $user = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $user;
    }

    /**
     * requete pour verifier l'exactitude du login et du mot de passe d'un utilisateur lors de sa connexion
     *
     * @param  mixed $user
     * @param  mixed $password
     * @return array
     */
    public function check($user, $password)
    {
        $dtb = $this->dbConnect();
        $req = $dtb->prepare('SELECT * FROM user WHERE login=? AND active_account=1');
        $req->execute(array($user));
        $user = $req->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        $check = password_verify($password, $user['password']);
        if (password_needs_rehash($user['password'], PASSWORD_BCRYPT)) {
            $password = password_hash($user['password'], PASSWORD_BCRYPT);
            $req = $dtb->prepare('UPDATE user SET password=? WHERE user_id=?');
            $req->execute(array($password, $user['user_id']));
        }

        if ($check) {

            $this->session->setValue('role', $user['role']);
            $this->session->setValue('user_id', $user['user_id']);
            $this->session->setValue('nickname', $user['nickname']);
            $this->session->setValue('first_name', $user['first_name']);
            $this->session->setValue('last_name', $user['last_name']);

            return true;
        }

        return false;
    }

    /**
     * fonction pour l'ajout en base de données d'un nouvel utilisateur lors de sa création
     *
     * @param  mixed $user
     * @return array
     */
    public function createVisitor($user)
    {
        $token = bin2hex(random_bytes(78));
        $dtb = $this->dbConnect();
        $req = $dtb->prepare("INSERT INTO user SET nickname = ?, login = ?, password = ?, role = 'Visitor', active_account = 0, token = ?, token_date = ?");

        $password = password_hash($user['password'], PASSWORD_BCRYPT);

        $req->execute(array($user['nickname'], $user['login'], $password, $token, date('Y-m-d H:i:s')));

        $visitor = $user['nickname'];

        mail($user['login'], "CoyoTech Blog - Confirmation de votre compte.", "Bonjour $visitor,\n\nVous avez demander à ouvrir un compte sur CoyoTech Blog. Vous trouverez ci-dessous un lien vous permettant de finaliser votre inscription.\n\nhttp://localhost:8888/blog-mvc/user/confirm/$token\n\nSi le lien ci-dessus ne fonctionne pas, vous pouvez copier / coller cette adresse directement dans la barre d'adresse de votre navigateur internet afin de finaliser votre inscription.");
    }
    
    /**
     * requete servant à vérifier si un pseudo est déjà utilisé
     *
     * @return void
     */
    public function checkNickname()
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('SELECT user_id FROM user WHERE nickname = ?');
        $req->execute([$_POST['nickname']]);
        return $req->fetch();
    }
    
    /**
     * requete servant à vérifier si un pseudo est déjà utilisé
     *
     * @return void
     */
    public function checkLogin()
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('SELECT user_id FROM user WHERE login = ?');
        $req->execute([$_POST['login']]);
        return $req->fetch();
    }
    
    /**
     * requete servant à vérifier si le lien token sur lequel l'utilisateur vient de cliquer est toujours valide. Si ok la base est mise à jour (token effacé)
     *
     * @param  mixed $token
     * @return array
     */
    public function checkToken($token)
    {

        $date = new \DateTime();

        $date->modify('-7 days');

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('SELECT * FROM user WHERE token = ? AND token_date >= ?');
        $req->execute(array($token, $date->format('Y-m-d H:i:s')));
        $check = $req->fetch(\PDO::FETCH_ASSOC);

        if (!$check) {
            return false;
        }

        $req = $dtb->prepare('UPDATE user SET active_account = 1, token = NULL WHERE token = ?');
        $req->execute(array($token));

        return true;
    }
    
    /**
     * requete préparant la base de données à ajouter un nouvel utilisateur depuis le Back-end
     *
     * @param  mixed $user
     * @return array
     */
    public function addUser($user)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('INSERT INTO user SET first_name=?, last_name=?, nickname=?, login=?, email=?, password=?, role=?, active_account=?');
        $password = password_hash($user['password'], PASSWORD_BCRYPT);

        $req->execute(array($user['firstname'], $user['lastname'], $user['nickname'], $user['login'], $user['email'], $password, $user['role'], $user['activeaccount']));
    }
    
    /**
     * requete préparant la base de données à être mise à jour suite à la modification d'un utilisateur depuis le Back-end
     *
     * @param  mixed $user
     * @return array
     */
    public function editUser($user)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('UPDATE user SET first_name=?, last_name=?, login=?, email=?, role=?, active_account=? WHERE user_id=?');
        $req->execute(array($user['firstname'], $user['lastname'], $user['login'], $user['email'], $user['role'], $user['activeaccount'], $user['userId']));

        if (isset($user['nickname'])) {
            $req = $dtb->prepare('UPDATE user SET nickname=? WHERE user_id=?');
            $req->execute(array($user['nickname'], $user['userId']));
        }

        if (isset($user['password']) && !empty($user['password'])) {
            $req = $dtb->prepare('UPDATE user SET password=? WHERE user_id=?');
            $req->execute(array(password_hash($user['password'], PASSWORD_BCRYPT), $user['userId']));
        }
    }
    
    /**
     * requete préparant la base de données à être mise à jour suite à la suppression d'un utilisateur depuis le Back-end
     *
     * @param  int $userId
     * @return array
     */
    public function delete($userId)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('DELETE FROM user WHERE user_id = ?');
        $req->execute(array($userId));
    }
}
