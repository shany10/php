<?php

namespace App\Controllers;
use App\Core\View;
use App\Models\Pictures;

class GalleryController
{
    public static function show()
    {
        $pictures = pictures::getAll();
        $view = new View("Pictures/gallery.php", "front.php");
        $view->addData("pictures", $pictures);
        return;
    }
}
