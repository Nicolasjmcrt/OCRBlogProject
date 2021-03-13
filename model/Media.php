<?php

require_once('model/Connect.php');

class Media extends Connect {


    public function addMedia($files, $caption, $article) {

        $ext = new SplFileInfo($files['media']['name']);
        $filename = "media/article/".uniqid().".".$ext->getExtension();
        rename($files['media']['tmp_name'], $filename);
           
        $db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO media SET caption=?, file_name=?, article_id=?');
		$req->execute(array($caption, $filename, $article['article_id'])); 
}


public function replaceMedia($files, $caption, $article) {

    $db = $this->dbConnect();
    $req = $db->prepare('DELETE from media WHERE article_id=?');
    $req->execute(array($article['article_id'])); 

    $this->addMedia($files, $caption, $article);
}


    public function getMedia($article_id) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM media WHERE article_id = ?');
        $req->execute(array($article_id));
        $media = $req->fetch(PDO::FETCH_ASSOC);

        return $media;
    }


}