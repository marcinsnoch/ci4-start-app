<?php

namespace App\Controllers;

class Terms extends BaseController
{
    public function index()
    {
        return $this->twig->display('terms/index');
    }
}
