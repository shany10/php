<?php

require_once __DIR__ . '/../Core/QueryBuilder.php';
require_once __DIR__ . '/../Core/DatabaseConnection.php';

$queryBuilder = new QueryBuilder();

$queryBuilder
    ->ifNotExists(true)
    ->createTable(
        "groups",
        [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "group_name" => "VARCHAR(255) NOT NULL",
            "owner_id" => "INT NOT NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        ["ENGINE=InnoDB", "DEFAULT CHARSET=utf8mb4"]
    )
    ->execute();

