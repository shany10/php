<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\UserModel;

class LoginController
{
  public static function index()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $email = $_POST["email"];
      $password = $_POST["password"];

      // Supposons que User ait une méthode findOneByEmail
      $user = UserModel::findOneByEmail($email);


    }

    $view = new View("User/login.php", "front.php");
    $view->addData("title", "Login");
  }
}
