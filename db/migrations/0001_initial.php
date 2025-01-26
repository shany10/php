<?php

require_once '../../sources/core/QueryBuilder.php';
require_once '../../sources/core/DatabaseConnection.php';

$queryBuilder = new QueryBuilder();

$queryBuilder
    ->createTable(
        "users",
        [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "email" => "VARCHAR(255) NOT NULL UNIQUE",
            "password" => "VARCHAR(255) NOT NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        ["ENGINE=InnoDB", "DEFAULT CHARSET=utf8mb4"]
    )
    ->execute();

echo "Table 'users' created successfully.";

$queryBuilder
    ->createTable(
        "pictures",
        [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "filename" => "VARCHAR(255) NOT NULL",
            "user_id" => "INT NOT NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            "FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE" 
        ],
        ["ENGINE=InnoDB", "DEFAULT CHARSET=utf8mb4"]
    )   
    ->execute();
echo "Table 'pictures' created successfully.";
