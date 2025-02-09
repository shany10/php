<?php

use App\Core\Router;
use App\Controllers\RegisterController;
use App\Controllers\ForgotPasswdController;
use App\Controllers\ResetPasswdController;

$router = new Router();
$router->get("/register", RegisterController::class, "index");
$router->post("/register", RegisterController::class, "index");
$router->get("/login", LoginController::class, "index");
$router->get("/forgotPassword", ForgotPasswdController::class, "index");
$router->post("/forgotPassword", ForgotPasswdController::class, "requestReset");
$router->get("/resetPassword", ResetPasswdController::class, "index");






// die();

