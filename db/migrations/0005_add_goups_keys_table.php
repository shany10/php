<?php

require_once __DIR__ . '/../Core/QueryBuilder.php';
require_once __DIR__ . '/../Core/DatabaseConnection.php';

$queryBuilder = new QueryBuilder();

$queryBuilder
    ->ifNotExists(true)
    ->createTable(
        "groups_keys",
        [
            "id_user" => "INT NOT NULL",
            "id_groupe" => "INT NOT NULL"
        ],
        ["ENGINE=InnoDB", "DEFAULT CHARSET=utf8mb4"]
    )
    ->execute();
