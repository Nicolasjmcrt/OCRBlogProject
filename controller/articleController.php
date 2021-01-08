<?php

require_once('model/Article.php');

class articleController {

	public function list() {
		$article = new Article();
		$articles = $article->getArticles();

		require('view/listArticles.php');
	}



	public function lastArticles() {
		$article = new Article();
		$articles = $article->getLastArticles();

		require('view/listArticles.php');
	}


	public function backendList() {
		$article = new Article();
		$articles = $article->getArticles();

		require('view/backendArticlesList.php');
	}


	public function view($articleId) {
		$article = new Article();

		echo '<pre>';
		print_r($article->getArticle($articleId));
	}


	public function delete($articleId) {
		$article = new Article();
		$article->delete($articleId);
	}
}