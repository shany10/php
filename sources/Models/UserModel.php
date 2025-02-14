<?php

namespace App\Models;

use App\Core\QueryBuilder;
use PDOException;

class UserModel
{
  

    public function __construct(
        private int $id,
        private string $email,
        private string $fristname,
        private string $lastname,
        private string $country,
        private string $role,
        private string $pwd ,
    )
    {
    }

    /**
     * @return int|null
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->email = strtolower(trim($id));
    }

  
    /**
     * @return String|null
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
