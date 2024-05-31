<?php

namespace App\Controllers;

use App\Utils\RenderView;

class HomeController extends RenderView
{
    public function index()
    {
        $this->loadView('home', [
            'title' => ''
        ]);
    }
}
