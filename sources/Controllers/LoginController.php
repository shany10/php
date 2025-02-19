<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\UserModel;
use App\Validator\DataPostValidator;
use App\Core\QueryBuilder;

class LoginController
{
    public static function index()
    {

        if (!empty($_SESSION["user"]) && $_SERVER["REQUEST_URI"] !== "/") {
            header("Location: /");
            exit;
        }


        $response = DataPostValidator::validate(
            $_POST,
            [
                'email',
                'password',
            ],
        );

        if ($response["error"] === false) {
            $email = strtolower(trim(htmlspecialchars($_POST["email"])));
            $password = $_POST["password"];

            $user = UserModel::findOneByEmail($email);

            if ($user && password_verify($password, $user->getPwd())) {
                if (!$user->isVerified()) {
                    $response["msg"][] = "Votre compte n'est pas encore vérifié.";
                } else {
                    $_SESSION["user"] = serialize($user);
                    header("Location: /home");
                    exit;
                    return;
                }
            } else {
                $response["msg"][] = "Email ou mot de passe incorrect.";
            }
        }

        $view = new View("User/login.php", "front.php");
        $view->addData("title", "Login");
        $view->addData('errors', $response["msg"]);
        return;
    }

    public static function logout()
    {
        session_destroy();
        header("Location: /login");
    }
}
