<?php

namespace App\Models;

use App\Core\QueryBuilder;

class UserModel
{

    private ?int $id;
    private ?string $email;
    private ?string $pwd;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $country;
    private ?string $role;
    private ?string $verification_code;
    private bool $is_verified;


    public function __construct(
        ?int $id = null,
        ?string $email = "",
        ?string $pwd = "",
        ?string $firstname = "",
        ?string $lastname = "",
        ?string $country = "",
        ?string $role = 'user',
        ?string $verification_code = "",
        bool $is_verified = false,
        
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->country = $country;
        $this->role = $role;
        $this->verification_code = $verification_code;
        $this->is_verified = $is_verified;
    }


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
        $this->id = $id;
    }

    /**
     * @return String|null
     */
    public function getFirstname(): string|null
    {

        return $this->firstname;

    }

    /**
     * @param String $fristname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = strtolower(trim($firstname));
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
    public function setLastname(string $lastname): void
    {
        $this->lastname = strtolower(trim($lastname));
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

    public function setPwd(string $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_BCRYPT);
    }

    public function getVerificationCode(): string
    {
        return $this->verification_code;
    }

    public function setVerificationCode(string $code): void
    {
        $this->verification_code = trim($code);
    }

    public function isVerified(): bool
    {
        return $this->is_verified;
    }

    public function setIsVerified(bool $status): void
    {
        $this->is_verified = $status;
    }

    public static function findOneByEmail(string $email): ?self
    {
        $email = strtolower(trim($email));

        $queryBuilder = new QueryBuilder();

        $user = $queryBuilder
            ->select(["id", "email", "password", "firstname", "lastname", "country", "role",  "verification_code", "is_verified"])
            ->from("users")
            ->where("email", $email)
            ->fetch();

        if (!$user) {
            return null;
        }

        return new self(
            $user["id"], 
            $user["email"], 
            $user["password"],                     // $id
            $user["firstname"],                 // $firstname
            $user["lastname"],                  // $lastname
            $user["country"],                   // $country
            $user["role"],                      // $ro    // $pwd
            $user["verification_code"] ?? "",   // $verification_code
            (bool) $user["is_verified"],        // $is_verified
        );
    }

    public function saveUser(): int
    {
        $queryBuilder = new QueryBuilder();
        $id = $queryBuilder
            ->insert("users", [
                "email" => $this->email,
                "password" => $this->pwd,
                "firstname" => $this->firstname,
                "lastname" => $this->lastname,
                "country" => $this->country,
                "verification_code" => (string) $this->verification_code,
                "is_verified" => (int) $this->is_verified
            ])
            ->executeAndGetId();
        $this->id = $id;
        $this->role = "user";
        return $id;
    }



    public function update(): bool
    {
        if (!$this->id) {
            return false;
        }

        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->update("users", [
                "verification_code" => $this->is_verified ? null : (string) $this->verification_code,
                "is_verified" => (int) $this->is_verified
            ])
            ->where("id", $this->id)
            ->execute();
    }
}
