<?php

class sessionController
{

    public function getSession()
    {

        return $_SESSION;
    }

    public function getValue($key)
    {

        return $_SESSION[$key];
    }

    public function reset()
    {

        session_unset();
        session_destroy();
    }

}
