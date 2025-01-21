<?php

// TODO: utiliser la casse ReflectionClass
// https://www.php.net/manual/fr/class.reflection.php

require_once __DIR__ . "/core/Router.php";

require_once __DIR__ . "/controllers/LoginController.php";
require_once __DIR__ . "/controllers/RegisterController.php";

$router = new Router();

$router->get("/register", RegisterController::class, "register");
$router->get("/login", LoginController::class, "index");
$router->post("/login", LoginController::class, "login");

$router->start();
