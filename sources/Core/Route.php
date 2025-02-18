<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\GroupeController;
use App\Controllers\GalleryController;
use App\Controllers\PictureController;
use App\Controllers\RegisterController;
use App\Controllers\ResetPasswdController;
use App\Controllers\ForgotPasswdController;

$router = new Router();
$router->get("/home", HomeController::class, "index");
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
$router->get("/groupe", GroupeController::class, "index");
$router->post("/createGroupe", GroupeController::class, "create");
$router->post("/addUserToGroupe", GroupeController::class, "addUserToGroupe");
$router->post("/deleteGroupe", GroupeController::class, "delete");
$router->get("/logout", LoginController::class, "logout");

// die();

