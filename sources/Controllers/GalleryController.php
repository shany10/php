<?php

namespace App\Controllers;
use App\Core\View;
use App\Models\Pictures;
use App\Models\GroupModel;

class GalleryController
{
    public static function show()
    {
        if(empty($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $pictures = [];
        if(!empty($_GET['groupe_id'])) {
            $pictures = pictures::getPicturesByGroup($_GET['groupe_id']);
        }
        $user = unserialize($_SESSION['user']);
        $groupes = GroupModel::getGroupsByUser($user->getId());
        $view = new View("Pictures/gallery.php", "front.php");
        $view->addData("pictures", $pictures);
        $view->addData("title", "Gallery");
        $view->addData("groupes", $groupes);

    }
}
