<?php

class Request
{
  public function isMethod(string $method): bool
  {
    return $method === $_SERVER["REQUEST_METHOD"];
  }

  public function input(string $name, string $fallback = ""): string
  {
    if (!isset($_REQUEST[$name])) {
      return $fallback;
    }

    return $_REQUEST[$name];
  }
}
