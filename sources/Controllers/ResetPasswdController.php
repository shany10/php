<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\QueryBuilder;

class ResetPasswdController
{
    public static function index()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : null;


        if (!$token) {
            echo "Token manquant.";
            exit;
        }

        $queryBuilder = new QueryBuilder();

        $user = $queryBuilder
            ->select(["id", "email", "token"])
            ->from("password_resets")
            ->where("token", $token)
            ->fetch();

        if (!$user) {
            echo "Token invalide ou expiré.";
            exit;
        }

        $view = new View("User/resetPasswd.php");
        $view->addData("token", $token); 
    }
}
