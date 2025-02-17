<?php

namespace App\Controllers;

use App\Core\View;

class HomeController
{
    public static function index()
    {
        $view = new View("home.php", "front.php");
        $view->addData("title", "home page");
    }
}