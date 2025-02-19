<?php

require_once __DIR__ . '/../Core/QueryBuilder.php';
require_once __DIR__ . '/../Core/DatabaseConnection.php';

$queryBuilder = new QueryBuilder();

// Ajout de la clé étrangère avec owner_id au lieu de user_id
$queryBuilder
    ->addForeignKey('groups', 'owner_id', 'users', 'id')
    ->execute();

echo "Table 'groups' created successfully with foreign key constraint.";

// Ajout des clés étrangères
$queryBuilder
    ->addForeignKey("pictures", "user_id", "users", "id")
    ->execute();

$queryBuilder
    ->addForeignKey("pictures", "group_id", "groups", "id")
    ->execute();

echo "Table 'pictures' created successfully with foreign key constraints.";

