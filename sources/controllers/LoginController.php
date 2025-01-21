<?php

require_once __DIR__ . "/../core/Request.php";

class LoginController
{
  public static function index()
  {
    require_once __DIR__ . "/../views/login/index.php";
  }

  public static function login()
  {
    $request = new Request();
    $email = $request->input("email", "unknown@domain.com");
    $password = $request->input("password");

    $databaseConnection = new PDO(
      "mysql:host=mariadb;dbname=database",
      "user",
      "password"
    );

    // SELECT password FROM users WHERE email = :email

    $getUserQuery = $databaseConnection->prepare("SELECT password FROM users WHERE email = :email");

    $getUserQuery->execute([
      "email" => $email
    ]);

    $user = $getUserQuery->fetch();

    if (!$user) {
      echo "TODO: renvoyer sur la page du formulaire avec une erreur";
      die();
    }

    $isPasswordValid = password_verify($password, $user["password"]);

    if (!$isPasswordValid) {
      echo "TODO: renvoyer sur la page du formulaire avec une erreur";
      die();
    }

    // TODO: enregistrer une session pour cet utilisateur

    // TODO: renvoyer sur une page de profil (ou page de création de photos)
  }
}
