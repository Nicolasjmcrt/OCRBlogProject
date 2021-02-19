æ<?php

require_once ('model/Article.php');
require_once ('model/User.php');
require_once ('model/Comment.php');
require_once ('model/Media.php');
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


	public function add($articleId) {

		$article = new Article();

		$user = new User();
		$user = $user->getAuthor($articleId);
		$media = new Media();

		if(!empty($_POST)) {
			// var_dump($_POST);
			// var_dump($_FILES);
			// exit();
			$article->addArticle($_POST);
			$media->addMedia($_FILES);

			header('Location: /blog-mvc/Article/admin');
		}

	
		echo $this->twig->render('article/addArticle.php.twig', ['user' => $user, 'article' => $article, 'pageTitle' => 'BackArticles']);
	}



	public function edit($article_id) {

		$articleModel = new Article();
		$article = $articleModel->getArticle($article_id);

		$user = new User();
		$user = $user->getAuthor($article_id);

		if(!empty($_POST)) {
			// var_dump($_POST);
			// exit();
			$articleModel->editArticle($_POST);
			header('Location: /blog-mvc/Article/admin');
		}

		echo $this->twig->render('article/editArticle.php.twig', ['user' => $user, 'article' => $article, 'pageTitle' => 'BackArticles']);
	}


	public function delete($articleId) {
		$article = new Article();
		$article->delete($articleId);

		header('Location: /blog-mvc/Article/admin');
	}
}