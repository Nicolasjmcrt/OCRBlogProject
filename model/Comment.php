<?php
require_once('model/Connect.php');

class Comment extends Connect {

	public function getInvalidComments() {

		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM comment WHERE validation = 0');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}


	public function getArticleComments($articleId) {

		$db = $this->dbConnect();
		$result = $db->prepare('SELECT comment_id, content, comment_date, validation, user_id FROM comment WHERE article_id = ? AND validation = 1 ORDER BY comment_date DESC');
		$result->execute(array($articleId));

		return $result;

	}


	public function getComment($commentId) {

	$db = $this->dbConnect();
	$req = $db->prepare('SELECT comment_id, content, comment_date, validation FROM comment WHERE comment_id = ?');
	$req->execute(array($commentId));
	$comment = $req->fetch(PDO::FETCH_ASSOC);

	return $comment;

	}


	public function delete($commentId) {

		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comment WHERE comment_id = ?');
		$req->execute(array($commentId));
	}

}