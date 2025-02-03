<?php

use App\Core\Router;
use App\Controllers\RegisterController;

$router = new Router();
$router->get("/register", RegisterController::class, "index");
$router->post("/register", RegisterController::class, "index");

// die();

