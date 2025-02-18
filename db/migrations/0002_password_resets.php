<?php

require_once __DIR__ . '/../Core/QueryBuilder.php';
require_once __DIR__ . '/../Core/DatabaseConnection.php';

$queryBuilder = new QueryBuilder();

$queryBuilder
   ->ifNotExists(true)
   ->createTable(
      "password_resets",
      [
         "id" => "INT AUTO_INCREMENT PRIMARY KEY",
         "email" => "VARCHAR(255) NOT NULL",
         "token" => "VARCHAR(64) NOT NULL UNIQUE",
         "expires_at" => "DATETIME NOT NULL",
         "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
      ],
      ["ENGINE=InnoDB", "DEFAULT CHARSET=utf8mb4"]
   )
   ->execute();

echo "Table 'password_resets' created successfully.";
