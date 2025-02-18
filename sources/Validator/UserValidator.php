<?php

namespace App\Validator;

class UserValidator
{

    public Object $user;

    private String $pwdConfirm;

    private array $errors = [];

    public function __construct(Object $user, String $pwdConfirm)
    {
        $this->user = $user;
        $this->pwdConfirm = $pwdConfirm;

        if (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Email est invalide";
        }

        $blockedDomains = ['tempmail.com', 'disposablemail.com'];
        $emailDomain = substr(strrchr($user->getEmail(), "@"), 1);
        if (in_array($emailDomain, $blockedDomains)) {
            $this->errors[] = "Les emails temporaires ou jetables sont interdits.";
        }

        if (
            strlen($this->pwdConfirm) < 8 ||
            !preg_match("/[a-z]/", $this->pwdConfirm) ||
            !preg_match("/[0-9]/", $this->pwdConfirm) ||
            !preg_match("/[A-Z]/", $this->pwdConfirm)
        ) {
            $this->errors[] = "Le mot de passe doit faire au min 8 caractère avec min maj chiffres";
        } else if (!password_verify($this->pwdConfirm, $user->getPwd())) {
            $this->errors[] = "Le mot de passe de confirmation ne correspond pas";
        }
    }



    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }
}
