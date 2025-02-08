<?php

namespace App\Models;

use App\Core\QueryBuilder;

class User
{
  private function __construct(
    public int $id,
    public string $email,
    public string $password
  ) {
  }

  public static function findOneByEmail(string $email): User|null
  {
    $queryBuilder = new QueryBuilder();
    $user = $queryBuilder
      ->select(["email", "password", "id"])
      ->from("users")
      ->where("email", $email)
      ->fetch();

    if (!$user) {
      return null;
    }

    return new User($user["id"], $user["email"], $user["password"]);
  }
  

  public function isValidPassword(string $password): bool
  {
    return password_verify($password, $this->password);
  }
}
