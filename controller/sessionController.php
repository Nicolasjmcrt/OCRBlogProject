<?php

namespace controller;

class sessionController
{
    public function __construct()
    {
        if (!isset($_SESSION['message'])) {
            $_SESSION['message'] = '';
        }

    }

    public function getSession()
    {

        return $_SESSION;
    }

    public function getValue($key)
    {

        return $_SESSION[$key];
    }

    public function setValue($key, $value)
    {

        $_SESSION[$key] = $value;
    }

    public function reset()
    {

        session_unset();
        session_destroy();
    }

}
