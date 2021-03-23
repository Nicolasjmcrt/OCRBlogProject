<?php

require_once 'model/Article.php';
require_once 'controller/Controller.php';

class homeController extends Controller {



    public function list() {
		$article = new Article();
		$articles = $article->getLastArticles();

		$this->view->show('home/home.php.twig', ['articles' => $articles, 'pageTitle' => 'Home']);
	}

}