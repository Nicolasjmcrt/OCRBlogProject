<?php

namespace model;

use model\Connect;

class Comment extends Connect
{
    
    /**
     * requête en base de données pour afficher les commentaires non validés
     *
     * @return void
     */
    public function getInvalidComments()
    {

        $dtb = $this->dbConnect();
        $req = $dtb->query('SELECT comment.*, user.*, article.article_id, article.title FROM comment INNER JOIN user ON comment.user_id=user.user_id INNER JOIN article ON comment.article_id=article.article_id WHERE validation = 0');
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     * requête en base de données pour afficher tous les commentaires d'un article à l'aide son id
     *
     * @param  int $articleId
     * @return void
     */
    public function getArticleCommentsFull(int $articleId)
    {

        $dtb = $this->dbConnect();
        $result = $dtb->prepare('SELECT comment.*, user.* FROM comment INNER JOIN user ON comment.user_id= user.user_id WHERE article_id=? AND validation=1 ORDER BY comment_date ASC');
        $result->execute(array($articleId));
        $comments = $result->fetchAll(\PDO::FETCH_ASSOC);

        return $comments;

    }
    
    /**
     * requête pour préparer la base de données pour ajouter un commentaire concernant un article et en lui créant un id
     *
     * @param  int $comment
     * @return void
     */
    public function addComment($comment)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('INSERT INTO comment SET content=?, comment_date=?, validation=0, user_id=?, article_id = ?');

        if (!empty($_POST)) {
            $user = $_POST['userId'];
            $article = $_POST['articleId'];
        }

        $req->execute(array($comment['content'], date('Y-m-d H:i:s'), $user, $article));

    }
    
    /**
     * requête pour mettre à jour la base de données suite à la validation d'un commentaire grâce à son id
     *
     * @param  int $commentId
     * @return void
     */
    public function validate(int $commentId)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('UPDATE comment SET validation=1 WHERE comment_id = ?');
        $req->execute(array($commentId));
    }
    
    /**
     * requête pour mettre à jour la base de données suite à la suppression d'un commentaire grâce à son id
     *
     * @param  int $commentId
     * @return void
     */
    public function delete(int $commentId)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('DELETE FROM comment WHERE comment_id = ?');
        $req->execute(array($commentId));
    }

}
