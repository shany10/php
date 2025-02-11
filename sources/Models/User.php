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

  

  public function isValidPassword(string $password): bool
  {
    return password_verify($password, $this->password);
  }
}
