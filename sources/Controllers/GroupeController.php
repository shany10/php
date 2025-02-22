<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\GroupModel;
use App\Models\Pictures;
use App\Models\UserModel;
use App\Validator\DataPostValidator;

class GroupeController
{

    public static function index()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
            return;
        }
        $user = unserialize($_SESSION['user']);
        $groupes = GroupModel::getGroupsByUser($user->getId());
        $view = new View("Groupe/groupe.php", "front.php");
        $view->addData("title", "Groupes");
        $view->addData("groupes", $groupes);
    }

    public static function create()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
            return;
        }
        $response = DataPostValidator::validate($_POST, ['group_name']);

        if (!$response["error"]) {
            $user = unserialize($_SESSION['user']);
            $id_groupe = GroupModel::creatGroupe($user->getId(), $_POST['group_name']);
            if ($id_groupe != 0)  {
                GroupModel::linkFriendToGroup($user->getId(), $id_groupe);
                $response["msg"][] = "Groupe créé avec succès";
            }
            else $response["msg"][] = "Erreur lors de la création du groupe";
        }

        $user = unserialize($_SESSION['user']);
        $groupes = GroupModel::getGroupsByUser($user->getId());
        $view = new View("Groupe/groupe.php", "front.php");
        $view->addData("title", "Groupes");
        $view->addData("groupes", $groupes);
        $view->addData("messages", $response["msg"]);
        unset($_POST['id_groupe']);
    }

    public static function addUserToGroupe()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
            return;
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
        $groupes = GroupModel::getGroupsByUser($user->getId());
        $view = new View("Groupe/groupe.php", "front.php");
        $view->addData("title", "Groupes");
        $view->addData("groupes", $groupes);
        $view->addData("messages", $response["msg"]);
        unset($_POST['id_groupe']);
    }

    public static function delete () 
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
            return;
        }

        $user = unserialize($_SESSION['user']);
        $response = DataPostValidator::validate($_POST, ['id_groupe']);
        if (!$response["error"]) {
            Pictures::delete($user->getId(), $_POST['id_groupe']);
            $isDeleted = GroupModel::deleteGroup($user->getId(), $_POST['id_groupe']);
            if ($isDeleted) $response["msg"][] = "Groupe supprimé avec succès";
            else $response["msg"][] = "Erreur lors de la suppression du groupe";
        }

        $groupes = GroupModel::getGroupsByUser($user->getId());
        $view = new View("Groupe/groupe.php", "front.php");
        $view->addData("title", "Groupes");
        $view->addData("groupes", $groupes);
        $view->addData("messages", $response["msg"]);
        unset($_POST['id_groupe']);
    }
}
