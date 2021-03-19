<?php

require_once 'model/Connect.php';

class Article extends Connect {

	public function getAllArticles() {

		$dtb = $this->dbConnect();
		$req = $dtb->query('SELECT * FROM article ORDER BY update_date DESC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}


	public function getArticles() {

		$dtb = $this->dbConnect();
		$req = $dtb->query('SELECT article.*, media.* FROM article INNER JOIN media ON article.article_id=media.article_id WHERE publication = 1 ORDER BY update_date DESC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getArticleFromComment() {

		$dtb = $this->dbConnect();
		$req = $dtb->query('SELECT article.*, comment.* FROM article INNER JOIN comment ON article.article_id=comment.article_id WHERE validation=0');
		$comment = $req->fetch(PDO::FETCH_ASSOC);
	}

	public function getLastId() {
		$dtb = $this->dbConnect();
		$req = $dtb->query('SELECT article_id FROM article WHERE publication = 1 ORDER BY update_date DESC LIMIT 0,1');
		$result = $req->fetch(PDO::FETCH_ASSOC);

		return $result['article_id'];
	}


	public function getLastArticles() {
		$dtb = $this->dbConnect();
		$req = $dtb->query('SELECT article.*, media.* FROM article INNER JOIN media ON article.article_id=media.article_id WHERE publication = 1 ORDER BY update_date DESC LIMIT 0,3');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getArticle($article_id) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('SELECT * FROM article WHERE article_id = ?');
		$req->execute(array($article_id));
		$article = $req->fetch(PDO::FETCH_ASSOC);

		return $article;
	}

	public function getArticleFull($articleId) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('SELECT article.*, user.* FROM article INNER JOIN user ON article.user_id=user.user_id WHERE article_id = ?');
		$req->execute(array($articleId));
		$article = $req->fetch(PDO::FETCH_ASSOC);

		return $article;
	}

	

	public function addArticle($articleId) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('INSERT INTO article SET title=?, intro=?, catchphrase=?, content=?, update_date = ?, publication=?, user_id=?');

		$req->execute(array($articleId['title'], $articleId['intro'], $articleId['catchphrase'], $articleId['content'], date('Y-m-d H:i:s'), $articleId['publication'], $articleId['userId'])); 

		return $this->getArticle($dtb->lastInsertId());

	}



	public function editArticle($article_id) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('UPDATE article SET title=?, intro=?, catchphrase=?, content=?, update_date=?, publication=?, user_id=? WHERE article_id=?');
		$req->execute(array($article_id['title'], $article_id['intro'], $article_id['catchphrase'], $article_id['content'], date('Y-m-d H:i:s'), $article_id['publication'], $article_id['userId'], $article_id['articleId']));


	}


	public function delete($articleId) {

		$dtb = $this->dbConnect();
		$req = $dtb->prepare('DELETE FROM article WHERE article_id = ?');
		$req->execute(array($articleId));
	}
}