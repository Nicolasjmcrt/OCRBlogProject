<?php

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

		$success='';

		$article = new Article();
		$article = $article->getArticleFull($articleId);

		$mediaModel = new Media();
		$media = $mediaModel->getMedia($articleId);

		$comment = new Comment();

		if (!empty($_POST)) {

			$comment->addComment($_POST);

			$success="Votre commentaire a bien été pris en compte. Il sera publié après validation du modérateur.";
		}

		$comments = $comment->getArticleCommentsFull($articleId);
		

		echo $this->twig->render('article/articleView.php.twig', ['article' => $article, 'media' => $media, 'comments' => $comments, 'success' => $success, 'pageTitle' => 'Articles']);

	}


	public function add($articleId) {

		if ($_SESSION['role'] != 'Administrator' && $_SESSION['role'] != 'Author') {
			$this->redirect('/blog-mvc');
		}

		$article = new Article();
		$user = new User();
		$user = $user->getAuthor($articleId);
		$media = new Media();

		


		if(!empty($_POST)) {

			$newArticle = $article->addArticle($_POST);

			$media->addMedia($_FILES, $_POST['caption'], $newArticle);

			$this->redirect('/blog-mvc/Article/admin');
		}

	
		echo $this->twig->render('article/addArticle.php.twig', ['user' => $user, 'article' => $article, 'pageTitle' => 'BackArticles']);
	}



	public function edit($article_id) {

		if ($_SESSION['role'] != 'Administrator' && $_SESSION['role'] != 'Author') {
			$this->redirect('/blog-mvc');
		}
		
		$articleModel = new Article();
		$article = $articleModel->getArticle($article_id);
		$mediaModel = new Media();
		$media = $mediaModel->getMedia($article_id);
		$user = new User();
		$user = $user->getAuthor($article_id);

		if(!empty($_POST)) {
			// var_dump($_FILES);
			// exit();
			$articleModel->editArticle($_POST);
			if($_FILES['media']['size']) {
				$mediaModel->replaceMedia($_FILES, $_POST['caption'], $article); 
			}
			$this->redirect('/blog-mvc/Article/admin');
		}

		echo $this->twig->render('article/editArticle.php.twig', ['user' => $user, 'article' => $article, 'media' => $media, 'pageTitle' => 'BackArticles']);
	}


	public function delete($articleId) {
		if ($_SESSION['role'] != 'Administrator') {
			$this->redirect('/blog-mvc');
		}

		$article = new Article();
		$article->delete($articleId);

		$this->redirect('/blog-mvc/Article/admin');
	}
}