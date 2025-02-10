<?php

namespace App\Controllers;
use App\Core\View;
use App\Models\Pictures;

class GalleryController
{
    public static function show($groupId)
    {
        $pictures = pictures::getPicturesByGroup($groupId);
        $view = new View("Pictures/gallery.php", "front.php");
        $view->addData("pictures", $pictures);
        return;
    }
}
