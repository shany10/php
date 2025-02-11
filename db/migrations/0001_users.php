<?php

require_once __DIR__ . '/../Core/QueryBuilder.php';
require_once __DIR__ . '/../Core/DatabaseConnection.php';

$queryBuilder = new QueryBuilder();

$queryBuilder
    ->ifNotExists(true)
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
            "verification_code" => "INT NULL", 
            "is_verified" => "BOOLEAN DEFAULT FALSE", 
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        ["ENGINE=InnoDB", "DEFAULT CHARSET=utf8mb4"]
    )
    ->execute();

echo "Table 'users' updated successfully.";
