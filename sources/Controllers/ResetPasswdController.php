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
        $view->addData("title", "Réinitialisation du mot de passe");
        $view->addData("token", $token);
    }

    public static function updatePassword()
    {
        if (!isset($_POST['token']) || !isset($_POST['new_password'])) {
            echo "Token ou mot de passe manquant.";
            exit;
        }

        $token = $_POST['token'];
        $newPassword = $_POST['new_password'];
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $queryBuilder = new QueryBuilder();

        // Vérifier si le token existe
        $user = $queryBuilder
            ->select(["email"])
            ->from("password_resets")
            ->where("token", $token)
            ->fetch();

        if (!$user) {
            echo "Token invalide ou expiré.";
            exit;
        }

        $queryBuilder->reset();

        // Mettre à jour le mot de passe
        $updateSuccess = $queryBuilder
            ->update("users", ["password" => $hashedPassword])
            ->where("email", $user['email'])
            ->execute();

        if (!$updateSuccess) {
            echo "Échec de la mise à jour du mot de passe.";
        }

        $queryBuilder->reset();

        // Supprimer le token de la table password_resets
        $deleteSuccess = $queryBuilder
            ->delete("password_resets")
            ->where("token", $token)
            ->execute();

        if (!$deleteSuccess) {
            echo "Échec de la suppression du token.";
        }

        if($updateSuccess && $deleteSuccess) {
            header("Location: /");
        }
    }
}
