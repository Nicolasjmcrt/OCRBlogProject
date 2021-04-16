<?php

namespace controller;

use controller\Controller;
use model\Article;
use model\Comment;
use model\Media;
use model\User;

class articleController extends Controller
{

    /**
     * affichage liste des articles Front-end
     *
     * @return void
     */
    function list()
    {
        $article = new Article();
        $articles = $article->getArticles();

        $this->view->show('article/listArticles.php.twig', ['articles' => $articles, 'pageTitle' => 'Articles']);
    }

    /**
     * affichage liste des articles Front-end
     *
     * @return void
     */
    public function admin()
    {
        // echo '<pre>';
        // print_r($_SESSION);
        // exit();
        
        if ($this->session->getValue('role') != 'Administrator' && $this->session->getValue('role') != 'Author') {
            $this->redirect('/blog-mvc');
        }
        $article = new Article();
        $articles = $article->getAllArticles();
        // TODO: Lire la variable de session message et l'envoyer à la vue
        $message = $_SESSION['message'];

        // TODO: Vider la variable de session message
        $_SESSION['message'] = "";
        // echo $message;
        // exit();
        $this->view->show('article/backendArticlesList.php.twig', ['articles' => $articles, 'pageTitle' => 'BackArticles', 'message' => $message]);
    }

    /**
     * affichage du dernier article
     *
     * @return void
     */
    public function last()
    {
        $article = new Article();
        $lastId = $article->getLastId();
        $this->view($lastId);
    }

    /**
     * affichage d'un article
     *
     * @param  int $articleId
     * @return void
     */
    public function view($articleId)
    {

        $success = '';

        $article = new Article();
        $article = $article->getArticleFull($articleId);

        $mediaModel = new Media();
        $media = $mediaModel->getMedia($articleId);

        $comment = new Comment();

        if (!empty($_POST)) {

            $comment->addComment($_POST);

            $success = "Votre commentaire a bien été pris en compte. Il sera publié après validation du modérateur.";
        }

        $comments = $comment->getArticleCommentsFull($articleId);

        $this->view->show('article/articleView.php.twig', ['article' => $article, 'media' => $media, 'comments' => $comments, 'success' => $success, 'pageTitle' => 'Articles']);
    }
    
    /**
     * ajout d'un article
     *
     * @param  int $articleId
     * @return void
     */
    public function add($articleId)
    {
        // Accès uniquement autorisé pour l'administrateur
        if ($this->session->getValue('role') != 'Administrator' && $this->session->getValue('role') != 'Author') {
            $this->redirect('/blog-mvc');
        }

        $article = new Article();
        $user = new User();
        $user = $user->getAuthor($articleId);
        $media = new Media();

        if (!empty($_POST)) {

            $newArticle = $article->addArticle($_POST);

            $media->addMedia($_FILES, $_POST['caption'], $newArticle);
            // TODO: créer une variable de session message
            $_SESSION['message'] = "Votre article a bien été ajouté";
            
            $this->redirect('/blog-mvc/article/admin');
        }

        $this->view->show('article/addArticle.php.twig', ['user' => $user, 'article' => $article, 'pageTitle' => 'BackArticles']);
    }
    
    /**
     * modification d'un article
     *
     * @param  int $article_id
     * @return void
     */
    public function edit($article_id)
    {

        if ($this->session->getValue('role') != 'Administrator' && $this->session->getValue('role') != 'Author') {
            $this->redirect('/blog-mvc');
        }

        $articleModel = new Article();
        $article = $articleModel->getArticle($article_id);
        $mediaModel = new Media();
        $media = $mediaModel->getMedia($article_id);
        $user = new User();
        $user = $user->getAuthor($article_id);

        if (!empty($_POST)) {

            $articleModel->editArticle($_POST);
            if ($_FILES['media']['size']) {
                $mediaModel->replaceMedia($_FILES, $_POST['caption'], $article);
            }
            $this->redirect('/blog-mvc/article/admin');
        }

        $this->view->show('article/editArticle.php.twig', ['user' => $user, 'article' => $article, 'media' => $media, 'pageTitle' => 'BackArticles']);
    }
    
    /**
     * suppression d'un article
     *
     * @param  int $articleId
     * @return void
     */
    public function delete($articleId)
    {
        if ($this->session->getValue('role') != 'Administrator') {
            $this->redirect('/blog-mvc');
        }

        $article = new Article();
        $article->delete($articleId);

        $this->redirect('/blog-mvc/article/admin');
    }
}
