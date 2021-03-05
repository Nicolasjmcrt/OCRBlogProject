<?php
require_once('model/Connect.php');

class Comment extends Connect {

	public function getInvalidComments() {

		$db = $this->dbConnect();
		$req = $db->query('SELECT comment.*, user.*, article.article_id, article.title FROM comment INNER JOIN user ON comment.user_id=user.user_id INNER JOIN article ON comment.article_id=article.article_id WHERE validation = 0');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);
		// var_dump($result);
		// exit;
		return $result;
	}


	public function getArticleCommentsFull($articleId) {

		$db = $this->dbConnect();
		$result = $db->prepare('SELECT comment.*, user.* FROM comment INNER JOIN user ON comment.user_id= user.user_id WHERE article_id=? AND validation=1 ORDER BY comment_date ASC');
		$result->execute(array($articleId));
		$comments = $result->fetchAll(PDO::FETCH_ASSOC);

		return $comments;

	}


	public function addComment($comment) {


		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO comment SET content=?, comment_date=?, validation=0, user_id=?, article_id = ?');

		if (!empty($_POST)) {
			$user = $_POST['userId'];
			$article = $_POST['articleId'];
		}

		// var_dump($_POST);
		// exit();

		$req->execute(array($comment['content'], date('Y-m-d H:i:s'), $user, $article));


	}


	public function validate($commentId) {

		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comment SET validation=1 WHERE comment_id = ?');
		$req->execute(array($commentId));
	}
	

	public function delete($commentId) {

		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comment WHERE comment_id = ?');
		$req->execute(array($commentId));
	}

}