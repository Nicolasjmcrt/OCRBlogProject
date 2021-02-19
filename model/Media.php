<?php

require_once('model/Connect.php');

class Media extends Connect {


    public function addMedia($files) {

       
            var_dump($files);
            $ext = new SplFileInfo($files['media']['name']);
            var_dump($ext->getExtension());
            exit();

}

}