<?php

namespace model;

use model\Connect;

class Article extends Connect
{

    /**
     * retourne tous les articles afin de les afficher sur le Back-end
     *
     * @return void
     */
    public function getAllArticles()
    {

        $dtb = $this->dbConnect();
        $req = $dtb->query('SELECT * FROM article ORDER BY update_date DESC');
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * retourne tous les articles publiés ainsi que leur visuel respectif afin de les afficher sur le Front-end
     *
     * @return void
     */
    public function getArticles()
    {

        $dtb = $this->dbConnect();
        $req = $dtb->query('SELECT article.*, media.* FROM article INNER JOIN media ON article.article_id=media.article_id WHERE publication = 1 ORDER BY update_date DESC');
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * retourne le tout dernier article publié à l'aide de son id afin de l'afficher sur le Front-end
     *
     * @return void
     */
    public function getLastId()
    {
        $dtb = $this->dbConnect();
        $req = $dtb->query('SELECT article_id FROM article WHERE publication = 1 ORDER BY update_date DESC LIMIT 0,1');
        $result = $req->fetch(\PDO::FETCH_ASSOC);

        return $result['article_id'];
    }

    /**
     * retourne les 3 articles publiés ainsi que leur visuel respectif afin de les afficher sur le Front-end
     *
     * @return void
     */
    public function getLastArticles()
    {
        $dtb = $this->dbConnect();
        $req = $dtb->query('SELECT article.*, media.* FROM article INNER JOIN media ON article.article_id=media.article_id WHERE publication = 1 ORDER BY update_date DESC LIMIT 0,3');
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * retourne un article en fonction de son id
     *
     * @param  int $article_id
     * @return array
     */
    public function getArticle(int $article_id): array
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('SELECT * FROM article WHERE article_id = ?');
        $req->execute(array($article_id));
        $article = $req->fetch(\PDO::FETCH_ASSOC);

        return $article;
    }

    /**
     * retourne le contenu d'un article ainsi que son auteur en fonction de son id
     *
     * @param  int $articleId
     * @return array
     */
    public function getArticleFull(int $articleId)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('SELECT article.*, user.* FROM article INNER JOIN user ON article.user_id=user.user_id WHERE article_id = ?');
        $req->execute(array($articleId));
        $article = $req->fetch(\PDO::FETCH_ASSOC);

        return $article;
    }

    /**
     * permet d'ajouter le contenu d'un nouvel article en base de données et de lui attribuer un id
     *
     * @param  int $articleId
     * @return array
     */
    public function addArticle($articleId)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('INSERT INTO article SET title=?, intro=?, catchphrase=?, content=?, update_date = ?, publication=?, user_id=?');

        $req->execute(array($articleId['title'], $articleId['intro'], $articleId['catchphrase'], $articleId['content'], date('Y-m-d H:i:s'), $articleId['publication'], $articleId['userId']));

        return $this->getArticle($dtb->lastInsertId());
    }

    /**
     * permet de modifier le contenu d'un article en fonction de son id
     *
     * @param  int $article_id
     * @return array
     */
    public function editArticle($article_id)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('UPDATE article SET title=?, intro=?, catchphrase=?, content=?, update_date=?, publication=?, user_id=? WHERE article_id=?');
        $req->execute(array($article_id['title'], $article_id['intro'], $article_id['catchphrase'], $article_id['content'], date('Y-m-d H:i:s'), $article_id['publication'], $article_id['userId'], $article_id['articleId']));
    }

    /**
     * permet de supprimer un article en fonction de son id
     *
     * @param  int $articleId
     * @return array
     */
    public function delete(int $articleId)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('DELETE FROM article WHERE article_id = ?');
        $req->execute(array($articleId));
    }
}
