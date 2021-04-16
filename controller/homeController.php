<?php

namespace controller;

use controller\Controller;
use model\Article;

class homeController extends Controller
{

    /**
     * affichage de la page d'accueil avec les 3 derniers articles et la gestion du formulaire de contact
     *
     * @return void
     */
    function list() {
        $article = new Article();
        $articles = $article->getLastArticles();

        $message = $this->session->getValue('message');
        $this->session->setValue('message', "");
        

        if (!empty($this->post->getPost())) {
            $email_to = "contact.coyotech@gmail.com";
            $email_subject = "Nouveau message Blog CoyoTech";

            $nom = $this->post->getValue('lastname');
            $prenom = $this->post->getValue('firstname');
            $email = $this->post->getValue('email');
            $message_content = $this->post->getValue('message');

            $email_message = "Détail.\n\n";
            $email_message .= "Nom: " . $nom . "\n";
            $email_message .= "Prenom: " . $prenom . "\n";
            $email_message .= "Email: " . $email . "\n";
            $email_message .= "Message: " . $message_content . "\n";

            $headers = 'From: ' . $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($email_to, $email_subject, $email_message, $headers);

            $message = "Nous avons bien reçu votre message, nous reviendrons vers vous dans les plus brefs délais.";
        }

        $this->view->show('home/home.php.twig', ['articles' => $articles, 'pageTitle' => 'Home', 'message' => $message]);
    }

}
