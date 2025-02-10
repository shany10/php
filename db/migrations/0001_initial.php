<?php

use App\Core\QueryBuilder;

require_once __DIR__ . "/../../sources/Core/QueryBuilder.php";




$queryBuilder = new QueryBuilder();

// Création de la table 'users'
$queryBuilder
    ->createTable(
        "users",
        [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "email" => "VARCHAR(255) NOT NULL UNIQUE",
            "password" => "VARCHAR(255) NOT NULL",
            "firstname" => "VARCHAR(255) NOT NULL",
            "lastname" => "VARCHAR(255) NOT NULL",
            "country" => "VARCHAR(255) NOT NULL",
            "role" => "ENUM('user', 'admin') DEFAULT 'user'",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        ["ENGINE=InnoDB", "DEFAULT CHARSET=utf8mb4"]
    )
    ->execute();

echo "Table 'users' created successfully.";

// Création de la table 'password_resets'
$queryBuilder
    ->createTable(
        "password_resets",
        [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "email" => "VARCHAR(255) NOT NULL",
            "token" => "VARCHAR(64) NOT NULL",
            "expires_at" => "DATETIME NOT NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            "CONSTRAINT unique_email_token UNIQUE (email, token)" // Cette contrainte garantit que chaque email/token est unique.
        ],
        ["ENGINE=InnoDB", "DEFAULT CHARSET=utf8mb4"]
    )
    ->execute();

echo "Table 'password_resets' created successfully.";
