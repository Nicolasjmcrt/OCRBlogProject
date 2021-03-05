<?php

require_once ('model/Comment.php');
require_once ('model/Article.php');
require_once ('controller/Controller.php');

class commentController extends Controller {

	public function list() {

		$comment = new Comment();
		$comments = $comment->getInvalidComments();
				
		$article = new Article();
		$articles = $article->getArticleFromComment();

		if ($_SESSION['role'] == 'Author') {

			$this->redirect('/blog-mvc/article/admin');
		} elseif ($_SESSION['role'] != 'Administrator') {

			$this->redirect('/blog-mvc');
		}

		echo $this->twig->render('comment/invalidComments.php.twig', ['comments' => $comments, 'articles' => $articles, 'pageTitle' => 'Comments']);

	}


	public function view($commentId) {
		$comment = new Comment();

		echo '<pre>';
		print_r($comment->getComment($commentId));
	}


	public function validate($commentId) {
		$comment = new Comment();
		$comment->validate($commentId);

		if ($_SESSION['role'] != 'Administrator') {
			$this->redirect('/blog-mvc');
		}

		$this->redirect('/blog-mvc/Comment');
	}


	public function delete($commentId) {
		$comment = new Comment();
		$comment->delete($commentId);

		if ($_SESSION['role'] != 'Administrator') {
			$this->redirect('/blog-mvc');
		}

		$this->redirect('/blog-mvc/Comment');
	}

}



