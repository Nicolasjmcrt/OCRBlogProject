<?php

require_once('model/Connect.php');

class Article extends Connect {

	public function getAllArticles() {

		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM article ORDER BY article_id DESC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}


	public function getArticles() {

		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM article WHERE publication = 1 ORDER BY article_id ASC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}


	public function getLastArticles() {
		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM article ORDER BY article_id ASC LIMIT 0,3');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getArticle($articleId) {

		$db = $this->dbConnect();
		$req = $db->prepare('SELECT article_id, title, intro, content, update_date, publication FROM article WHERE article.article_id = article_id');
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