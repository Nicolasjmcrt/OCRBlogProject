<?php

require_once ('model/Article.php');
require_once ('controller/Controller.php');

class articleController extends Controller {

	public function list() {
		$article = new Article();
		$articles = $article->getArticles();
		echo $this->twig->render('article/listArticles.php.twig', ['articles' => $articles]);
	}



	

	public function backendList() {
		$article = new Article();
		$articles = $article->getAllArticles();

		echo $this->twig->render('article/backendArticlesList.php.twig', ['articles' => $articles]);
	}


	public function view($articleId) {
		$article = new Article();
		$article = $article->getArticle($articleId);

		echo $this->twig->render('article/articleView.php.twig', ['article' => $article]);

	}


	public function delete($articleId) {
		$article = new Article();
		$article->delete($articleId);
	}
}