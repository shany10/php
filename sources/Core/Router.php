<?php

namespace App\Core;

class Router
{
  private array $routes;

  public function __construct()
  {
    $this->routes = [];
  }

  // Méthode pour enregistrer les routes GET
  public function get(string $path, string $controllerName, string $methodName): void
  {
    $this->routes[] = [
      "method" => "GET",
      "path" => $path,
      "controllerName" => $controllerName,
      "methodName" => $methodName
    ];
  }

  // Méthode pour enregistrer les routes POST
  public function post(string $path, string $controllerName, string $methodName): void
  {
    $this->routes[] = [
      "method" => "POST",
      "path" => $path,
      "controllerName" => $controllerName,
      "methodName" => $methodName
    ];
  }


  // Recherche la route correspondant à la requête
  public function __destruct()
  {
    $method = $_SERVER["REQUEST_METHOD"];
    $url = $_SERVER["REQUEST_URI"];
    if($url === "/"){
      $url = "/login";
    }

    // Extraction du chemin de l'URL (avant le ?)
    $path = parse_url($url, PHP_URL_PATH);

    // Extraction des paramètres GET (après le ?)
    $queryParams = [];
    parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);

    foreach ($this->routes as $route) {
      if ($method === $route["method"] && $path === $route["path"]) {
        // Si la route correspond, récupérer la méthode du contrôleur et appeler le contrôleur
        $methodName = $route["methodName"];
        $controllerName = $route["controllerName"];

        // Appel de la méthode du contrôleur et passage des paramètres GET
        $controllerName::$methodName($queryParams);
        return; // Si la route est trouvée, on arrête la recherche
      }
    }
  }
}
