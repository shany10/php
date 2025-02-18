<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\GroupModel;

class HomeController
{
    public static function index()
    {
        if(empty($_SESSION["user"])) {
            header("Location: /login");
            return;
        }
        $user = unserialize($_SESSION["user"]);
        $groupes = GroupModel::getAllGroupeLinked($user->getId());
        $view = new View("home.php", "front.php");
        $view->addData("title", "Home");
        $view->addData("groupes", $groupes);                
    }
}