<?php

namespace App\Models;

use App\Core\QueryBuilder;
use PDOException;

class UserModel
{
    private String $email;
    private String $pwd;
  
    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return String
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param String $pwd
     */
    public function setPwd(string $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_BCRYPT);
    }

    public function save(): int
    {
        $queryBuilder = new QueryBuilder();
        $id = $queryBuilder
            ->insert("users", [
                "email" => $this->email,
                "password" => $this->pwd,
            ])
            ->executeAndGetId();
      
        return $id;       
    }
    
}
