<?php

require_once __DIR__ . "/../core/QueryBuilder.php";

$queryBuilder = new QueryBuilder();

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