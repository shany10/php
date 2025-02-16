<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\UserModel;
use App\Validator\DataPostValidator;


class LoginController
{
    public static function index()
    {
        if (empty($_SESSION["user"])) {
            header("Location: /");
            return;
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
                $_SESSION["user"] = serialize($user);
                header("Location: /");
                return;
            } else {
                $response["msg"][] =  "Invalid email or password.";
            }
        }

        $view = new View("User/login.php", "front.php");
        $view->addData("title", "Login");
        $view->addData('errors', $response["msg"]);
        return;
    }
}
