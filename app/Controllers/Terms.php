<?php

namespace App\Controllers;

class Terms extends BaseController
{
    public function index()
    {
        $this->twig->display('terms/index');
    }
}
