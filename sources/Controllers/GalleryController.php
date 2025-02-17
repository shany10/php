<?php

namespace App\Controllers;
use App\Core\View;
use App\Models\Pictures;

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
        $view = new View("Pictures/gallery.php", "front.php");
        $view->addData("pictures", $pictures);
    }
}
