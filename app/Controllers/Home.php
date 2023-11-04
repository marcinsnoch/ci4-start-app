<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if ($this->request->getGet('run') == 3) {
            alertDefault('Alert message', ['title' => 'Alert title', 'icon' => 'fas fa-envelope fa-lg', 'delay' => 7000]);
//            alertError('Alert message', ['delay' => 1000000]);
            return redirect()->to('home');
        }
        return $this->twig->display('home/index');
    }
}
