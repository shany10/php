<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\User;


class LoginController
{
  public static function index()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $email = strtolower(trim(htmlspecialchars($_POST["email"])));
      $password = $_POST["password"];

      $user = User::findOneByEmail($email);

      if ($user && password_verify($password, $user->password)) {
        $_SESSION["user"] = $user;
        header("Location: /gallery");
        exit();
      } else {
        echo "Invalid email or password.";
      }
    }

    $view = new View("User/login.php", "front.php");
    $view->addData("title", "Login");
    return;
  }
}
