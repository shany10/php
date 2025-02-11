<?php

namespace App\Models;

use App\Core\QueryBuilder;
use PDOException;

class UserModel
{
    private ?int $id;
    private string $email;
    private string $pwd;
    private ?int $verification_code;
    private bool $is_verified;

    public function __construct(?int $id = null, string $email = "", string $pwd = "", ?int $verification_code = null, bool $is_verified = false)
    {
        $this->id = $id;
        $this->email = strtolower(trim($email));
        $this->pwd = $pwd;
        $this->verification_code = $verification_code;
        $this->is_verified = $is_verified;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    public function getPwd(): string
    {
        return $this->pwd;
    }

    public function setPwd(string $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_BCRYPT);
    }

    public function getVerificationCode(): ?int
    {
        return $this->verification_code;
    }

    public function setVerificationCode(int $code): void
    {
        $this->verification_code = $code;
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
        $queryBuilder = new QueryBuilder();
        $user = $queryBuilder
            ->select(["id", "email", "password", "verification_code", "is_verified"])
            ->from("users")
            ->where("email", $email)
            ->fetch();

        if (!$user) {
            return null;
        }

        return new self(
            $user["id"],
            $user["email"],
            $user["password"],
            $user["verification_code"] ?? null,
            (bool) $user["is_verified"]
        );
    }

    public function save(): int
    {
        $queryBuilder = new QueryBuilder();
        $id = $queryBuilder
            ->insert("users", [
                "email" => $this->email,
                "password" => $this->pwd,
                "verification_code" => $this->verification_code,
                "is_verified" => (int) $this->is_verified
            ])
            ->executeAndGetId();

        $this->id = $id;
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
                "verification_code" => $this->verification_code,
                "is_verified" => (int) $this->is_verified
            ])
            ->where("id", $this->id)
            ->execute();
    }
}
