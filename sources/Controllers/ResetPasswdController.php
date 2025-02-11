<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\QueryBuilder;

class ResetPasswdController
{
    public static function index()
    {
        // Récupérer le paramètre token de l'URL
        $token = isset($_GET['token']) ? $_GET['token'] : null;

        // Debugging: afficher le token
        echo "Token récupéré : " . $token;  // Cette ligne t'aidera à voir si le token est bien passé dans l'URL

        // Vérification si le token est présent
        if (!$token) {
            echo "Token manquant.";
            exit;
        }

        // Créer une instance de QueryBuilder
        $queryBuilder = new QueryBuilder();

        // Vérifier si le token existe dans la base de données
        $user = $queryBuilder
            ->select(["id", "email", "reset_password_token"])  // Sélectionner les champs nécessaires
            ->from("users")  // Table des utilisateurs
            ->where("reset_password_token", $token)  // Filtrer par token
            ->fetch();  // Exécuter la requête et récupérer le premier résultat

        // Si aucun utilisateur n'a été trouvé ou si le token ne correspond pas
        if (!$user) {
            echo "Token invalide ou expiré.";
            exit;
        }

        // Si tout est valide, afficher le formulaire
        $view = new View("User/resetPasswd.php");
        $view->addData("token", $token);  // Passer le token au formulaire
    }
}
