<?php

namespace controller;

class postController
{

    public function getPost()
    {

        return $_POST;
    }

    public function getValue($key)
    {

        return $_POST[$key];
    }
}
