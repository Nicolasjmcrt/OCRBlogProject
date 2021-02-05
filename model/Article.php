<?php

require_once('model/Connect.php');

class Article extends Connect {

	public function getAllArticles() {

		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM article ORDER BY update_date DESC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}


	public function getArticles() {

		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM article WHERE publication = 1 ORDER BY update_date DESC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getArticleFromComment() {

		$db = $this->dbConnect();
		$req = $db->query('SELECT article.*, comment.* FROM article INNER JOIN comment ON article.article_id=comment.article_id WHERE validation=0');
		$comment = $req->fetch(PDO::FETCH_ASSOC);
	}

	public function getLastId() {
		$db = $this->dbConnect();
		$req = $db->query('SELECT article_id FROM article ORDER BY update_date DESC LIMIT 0,1');
		$result = $req->fetch(PDO::FETCH_ASSOC);

		return $result['article_id'];
	}


	public function getLastArticles() {
		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM article ORDER BY update_date DESC LIMIT 0,3');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getArticle($articleId) {

		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM article WHERE article_id = ?');
		$req->execute(array($articleId));
		$article = $req->fetch(PDO::FETCH_ASSOC);

		return $article;
	}

	public function getArticleFull($articleId) {

		$db = $this->dbConnect();
		$req = $db->prepare('SELECT article.*, user.* FROM article INNER JOIN user ON article.user_id=user.user_id WHERE article_id = ?');
		$req->execute(array($articleId));
		$article = $req->fetch(PDO::FETCH_ASSOC);

		return $article;
	}

	public function delete($articleId) {

		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM article WHERE article_id = ?');
		$req->execute(array($articleId));
	}
}