<?php

use App\Core\Router;
use App\Controllers\RegisterController;
use App\Controllers\ForgotPasswdController;
use App\Controllers\ResetPasswdController;
use App\Controllers\LoginController;
use App\Controllers\UserVerifyController;



$router = new Router();

$router->get("/register", RegisterController::class, "index");
$router->post("/register", RegisterController::class, "index");

$router->get("/login", LoginController::class, "index");
$router->post("/login", LoginController::class, "index");

$router->get("/forgotPassword", ForgotPasswdController::class, "index");
$router->post("/forgotPassword", ForgotPasswdController::class, "requestReset");

$router->get("/resetPassword", ResetPasswdController::class, "index");
$router->post("/resetPassword", ResetPasswdController::class, "updatePassword");

$router->get("/verify", UserVerifyController::class, "index");
$router->post("/verify", UserVerifyController::class, "index");








// die();
