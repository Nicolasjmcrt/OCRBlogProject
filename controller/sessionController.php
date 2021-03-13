<?php

class sessionController {

    public function getSession() {

        return $_SESSION;
    }


    public function getValue($key) {

        return $_SESSION[$key];
    }

}