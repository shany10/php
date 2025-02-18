<?php

use App\Core\Router;

use App\Controllers\RegisterController;
use App\Controllers\ForgotPasswdController;
use App\Controllers\ResetPasswdController;
use App\Controllers\LoginController;
use App\Controllers\UserVerifyController;
use App\Controllers\PictureController;
use App\Controllers\GalleryController;
use App\Controllers\HomeController;
use App\Controllers\GroupeController;

$router = new Router();
$router->get("/home", HomeController::class, "index");

$router->get("/register", RegisterController::class, "index");
$router->post("/register", RegisterController::class, "index");

$router->get("/", LoginController::class, "index");
$router->post("/", LoginController::class, "index");

$router->get("/forgotPassword", ForgotPasswdController::class, "index");
$router->post("/forgotPassword", ForgotPasswdController::class, "requestReset");

$router->get("/resetPassword", ResetPasswdController::class, "index");
$router->post("/resetPassword", ResetPasswdController::class, "updatePassword");

$router->get("/verify", UserVerifyController::class, "index");
$router->post("/verify", UserVerifyController::class, "index");

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
