<?php

require_once('model/Comment.php');

class commentController {

	public function invalidCommentsList() {
		$comment = new Comment();
		$comments = $comment->getInvalidComments();

		require('view/listInvalidComments.php');

	}

	public function articleCommentList($articleId) {
		$comment = new Comment();
		$comments = $comment->getArticleComments($articleId);

		require('view/listComments.php');
	}

	public function view($commentId) {
		$comment = new Comment();

		echo '<pre>';
		print_r($comment->getComment($commentId));
	}


	public function delete($commentId) {
		$comment = new Comment();
		$comment->delete($commentId);
	}

}