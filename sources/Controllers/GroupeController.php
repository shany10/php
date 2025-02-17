<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\GroupModel;
use App\Models\UserModel;
use App\Validator\DataPostValidator;

class GroupeController
{

    public static function create()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
        }
        $response = DataPostValidator::validate($_POST, ['group_name']);

        if (!$response["error"]) {
            $user = unserialize($_SESSION['user']);
            $isInserted = GroupModel::creatGroupe($user->getId(), $_POST['group_name']);
            if ($isInserted) $response["msg"][] = "Groupe créé avec succès";
            else $response["msg"][] = "Erreur lors de la création du groupe";
        }

        $view = new View("Groupe/createGroupe.php", "front.php");
        $view->addData("title", "Groupes");
        $view->addData("messages", $response["msg"]);
    }

    public static function addUserToGroup()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
        }

        $response = DataPostValidator::validate($_POST, ['id_groupe']);

        if (!$response["error"]) {

            $friend = UserModel::findOneByEmail($_POST['email']);
            $isOnrGroup = GroupModel::findFriendIntoGroup($friend->getId(), $_POST['id_groupe']);
            if (!$isOnrGroup) {
                $isInserted = GroupModel::linkFriendToGroup($friend->getId(), $_POST['id_groupe']);
                if ($isInserted) $response["msg"][] = "Utilisateur ajouté avec succès";
                else $response["msg"][] = "Erreur lors de l'ajout de l'utilisateur";
            } else $response["msg"][] = "L'utilisateur " . $friend->getEmail() . " est déjà dans ce groupe";
        }

        $user = unserialize($_SESSION['user']);
        $groups = GroupModel::getGroupsByUser($user->getId());
        $view = new View("Groupe/addUserToGroup.php", "front.php");
        $view->addData("title", "Groupes");
        $view->addData("groups", $groups);
        $view->addData("messages", $response["msg"]);
    }

    // public static function show()
    // {
    //     if (empty($_SESSION['user'])) {
    //         header('Location: /login');
    //     }

    //     $user = unserialize($_SESSION['user']);
    //     $groups = GroupModel::getGroupsByUser($user->getId());
    //     $view = new View("Groupe/showGroup.php", "front.php");
    //     $view->addData("title", "Groupes");
    //     $view->addData("groups", $groups);
    // }
}
