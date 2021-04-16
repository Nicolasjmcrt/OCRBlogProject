<?php

namespace controller;

use controller\Controller;
use model\Comment;

class commentController extends Controller
{

    /**
     * affiche la liste des commentaires en attente de validation
     *
     * @return void
     */
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

    /**
     * permet la validation d'un commentaire par l'administrateur
     *
     * @param  int $commentId
     * @return void
     */
    public function validate(int $commentId)
    {
        $comment = new Comment();
        $comment->validate($commentId);

        if ($this->session->getValue('role') != 'Administrator') {
            $this->redirect('/blog-mvc');
        }

        $this->redirect('/blog-mvc/comment');
    }

    /**
     * permet la suppression d'un commentaire par l'administrateur
     *
     * @param  int $commentId
     * @return void
     */
    public function delete(int $commentId)
    {
        $comment = new Comment();
        $comment->delete($commentId);

        if ($this->session->getValue('role') != 'Administrator') {
            $this->redirect('/blog-mvc');
        }

        $this->redirect('/blog-mvc/comment');
    }

}
