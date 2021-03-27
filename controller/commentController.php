<?php

require_once 'model/Comment.php';
require_once 'model/Article.php';
require_once 'controller/Controller.php';

class commentController extends Controller
{

    function list() {

        $comment = new Comment();
        $comments = $comment->getInvalidComments();

        if ($this->session->getValue('role') == 'Author') {

            $this->redirect('/blog-mvc/article/admin');
        } elseif ($this->session->getValue('role') != 'Administrator') {

            $this->redirect('/blog-mvc');
        }

        $this->view->show('comment/invalidComments.php.twig', ['comments' => $comments, 'pageTitle' => 'Comments']);

    }

    public function view($commentId)
    {
        $comment = new Comment();

        echo '<pre>';
        print_r($comment->getComment($commentId));
    }

    public function validate($commentId)
    {
        $comment = new Comment();
        $comment->validate($commentId);

        if ($this->session->getValue('role') != 'Administrator') {
            $this->redirect('/blog-mvc');
        }

        $this->redirect('/blog-mvc/Comment');
    }

    public function delete($commentId)
    {
        $comment = new Comment();
        $comment->delete($commentId);

        if ($this->session->getValue('role') != 'Administrator') {
            $this->redirect('/blog-mvc');
        }

        $this->redirect('/blog-mvc/Comment');
    }

}
