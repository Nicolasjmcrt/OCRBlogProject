<?php

require_once ('model/Article.php');
require_once ('model/Comment.php');
require_once ('controller/Controller.php');

class articleController extends Controller {

	public function list() {
		$article = new Article();
		$articles = $article->getArticles();
		echo $this->twig->render('article/listArticles.php.twig', ['articles' => $articles, 'pageTitle' => 'Articles']);
	}


	public function admin() {
		$article = new Article();
		$articles = $article->getAllArticles();

		echo $this->twig->render('article/backendArticlesList.php.twig', ['articles' => $articles, 'pageTitle' => 'BackArticles']);
	}

	public function last() {
		$article = new Article();
		$lastId = $article->getLastId();
		$this->view($lastId);
	}

	public function view($articleId) {
		$article = new Article();
		$article = $article->getArticleFull($articleId);

		$comment = new Comment();
		$comments = $comment->getArticleCommentsFull($articleId);
		

		echo $this->twig->render('article/articleView.php.twig', ['article' => $article, 'comments' => $comments, 'pageTitle' => 'Articles']);

	}


	public function delete($articleId) {
		$article = new Article();
		$article->delete($articleId);
	}
}