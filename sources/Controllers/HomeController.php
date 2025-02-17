<?php

namespace App\Controllers;

use App\Core\View;

class HomeController
{
    public static function index()
    {
        if(empty($_SESSION["user"])) {
            header("Location: /login");
            return;
        }
        $view = new View("home.php", "front.php");
        $view->addData("title", "home page");
    }
}