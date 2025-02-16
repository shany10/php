<?php

use App\Core\Router;
use App\Controllers\LoginController;
use App\Controllers\GroupeController;
use App\Controllers\GalleryController;
use App\Controllers\PictureController;
use App\Controllers\RegisterController;
use App\Controllers\ResetPasswdController;
use App\Controllers\ForgotPasswdController;

$router = new Router();
$router->get("/register", RegisterController::class, "index");
$router->post("/register", RegisterController::class, "index");
$router->get("/forgotPassword", ForgotPasswdController::class, "index");
$router->post("/forgotPassword", ForgotPasswdController::class, "requestReset");
$router->get("/resetPassword", ResetPasswdController::class, "index");
$router->get("/login", LoginController::class, "index");
$router->post("/login", LoginController::class, "index");
$router->get("/upload", PictureController::class, "showForm");
$router->post("/upload", PictureController::class, "upload");
$router->post('/delete/{id}', PictureController::class, 'delete');
$router->get("/gallery", GalleryController::class, "show");
$router->post("/gallery/{groupId}", GalleryController::class, "show");
$router->get("/createGroupe", GroupeController::class, "create");
$router->post("/createGroupe", GroupeController::class, "create");
$router->get("/addUserToGroup", GroupeController::class, "addUserToGroup");
$router->post("/addUserToGroup", GroupeController::class, "addUserToGroup");

// die();

