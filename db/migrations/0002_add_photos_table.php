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
            "file_name" => "VARCHAR(255) NOT NULL",
            "file_path" => "VARCHAR(255) NOT NULL",
            "user_id" => "INT NOT NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        ["ENGINE=InnoDB", "DEFAULT CHARSET=utf8mb4"]
    )
    ->execute();

// Now, we add the foreign key constraint separately
$queryBuilder
    ->addForeignKey('pictures', 'user_id', 'users', 'id')
    ->execute();

echo "Table 'pictures' created successfully with foreign key constraint.";
