<?php

namespace App\Controllers;

use App\Core\View;

class ResetPasswdController
{
   public static function index()
   {
      // Récupérer les paramètres de l'URL
      $email = $_GET['email'] ?? null;
      $token = $_GET['token'] ?? null;

      // Charger la vue en lui passant les variables
      $view = new View("User/resetPasswd.php", "front.php");
      $view->addData("email", $email);
      $view->addData("token", $token);
   }
}
