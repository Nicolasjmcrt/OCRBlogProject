<?php

namespace model;

use model\Connect;

class Media extends Connect
{
    
    /**
     * requête pour préparer la base de données pour ajouter un visuel et sa légende concernant un article tout en modifiant son nom, le déplaçant dans un dossier et lui créant un id
     *
     * @param  mixed $files
     * @param  mixed $caption
     * @param  mixed $article
     * @return array
     */
    public function addMedia($files, $caption, $article)
    {

        $ext = new \SplFileInfo($files['media']['name']);
        $filename = "media/article/" . uniqid() . "." . $ext->getExtension();
        rename($files['media']['tmp_name'], $filename);

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('INSERT INTO media SET caption=?, file_name=?, article_id=?');
        $req->execute(array($caption, $filename, $article['article_id']));
    }
    
    /**
     * requête pour mettre à jour la base de données suite à la modification d'un visuel et/ou de sa légende en fonction de son id
     *
     * @param  mixed $files
     * @param  mixed $caption
     * @param  mixed $article
     * @return array
     */
    public function replaceMedia($files, $caption, $article)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('DELETE from media WHERE article_id=?');
        $req->execute(array($article['article_id']));

        $this->addMedia($files, $caption, $article);
    }
    
    /**
     * requête pour préparer la base de données pour afficher un visuel concernant un article grâce à l'id de ce dernier
     *
     *
     * @param  int $article_id
     * @return array
     */
    public function getMedia(int $article_id)
    {

        $dtb = $this->dbConnect();
        $req = $dtb->prepare('SELECT * FROM media WHERE article_id = ?');
        $req->execute(array($article_id));
        $media = $req->fetch(\PDO::FETCH_ASSOC);

        return $media;
    }

}
