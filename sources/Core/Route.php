<?php

use App\Core\Router;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Controllers\PictureController;
use App\Controllers\GalleryController;

$router = new Router();
$router->get("/register", RegisterController::class, "index");
$router->post("/register", RegisterController::class, "index");

$router->get("/login", LoginController::class, "index");
$router->post("/login", LoginController::class, "index");

$router->get("/upload", PictureController::class, "upload");
$router->post("/upload", PictureController::class, "upload");

$router->post('/delete/{id}', PictureController::class, 'delete');


$router->get("/gallery", GalleryController::class, "show");
$router->post("/gallery", GalleryController::class, "show");




// die();

