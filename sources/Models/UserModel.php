<?php

namespace App\Models;

use App\Core\QueryBuilder;
use PDOException;

class UserModel
{


    public function __construct(
        private ?int $id = null,
        private ?string $email = null,
        private ?string $fristname = null,
        private ?string $lastname = null,
        private ?string $country = null,
        private ?string $role = null,
        private ?string $pwd = null,
    ) {}

    /**
     * @return int|null
     */
    public function getId(): int|null
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
    public function getFirstname(): string|null
    {
        return $this->fristname;
    }

    /**
     * @param String $fristname
     */
    public function setFirstname(string $fristname): void
    {
        $this->fristname = strtolower(trim($fristname));
    }

    /**
     * @return String|null
     */
    public function getLastname(): string|null
    {
        return $this->lastname;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $fristname): void
    {
        $this->lastname = strtolower(trim($fristname));
    }

    /**
     * @return String|null
     */
    public function getCountry(): string|null
    {
        return $this->country;
    }

    /**
     * @param String $country
     */
    public function setCountry(string $country): void
    {
        $this->country = strtolower(trim($country));
    }

    /**
     * @return String|null
     */
    public function getRole(): string|null
    {
        return $this->role;
    }

    /**
     * @param String $role
     */
    public function setRole(string $role): void
    {
        $this->role = strtolower(trim($role));
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
     * @return String|null
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
                "firstname" => $this->fristname,
                "lastname" => $this->lastname,
                "country" => $this->country,
            ])
            ->executeAndGetId();
        $this->id = $id;
        $this->role = "user";
        return $id;
    }

    public static function findOneByEmail(string $email): UserModel|null
    {
        $queryBuilder = new QueryBuilder();
        $user = $queryBuilder
          ->select(["id", "email", "firstname", "lastname", "country", "role", "password"])
          ->from("users")
          ->where("email", $email)
          ->fetch();

        if (!$user) {
          return null;
        }
        return new UserModel($user["id"], $user["email"], $user["firstname"], $user["lastname"], $user["country"], $user["role"], $user["password"]);
    }
}
