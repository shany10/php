<?php

require_once __DIR__ . '/../Core/QueryBuilder.php';
require_once __DIR__ . '/../Core/DatabaseConnection.php';

$queryBuilder = new QueryBuilder();

$queryBuilder
    ->ifNotExists(true)
    ->createTable(
        "pictures",
        [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "file_path" => "VARCHAR(255) NOT NULL",
            "file_name" => "VARCHAR(100) NOT NULL",
            "user_id" => "INT NOT NULL",
            "group_id" => "INT NOT NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        ["ENGINE=InnoDB", "DEFAULT CHARSET=utf8mb4"]
    )
    ->execute();


