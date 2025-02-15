<?php

namespace App\Core;

use PDO;

class DatabaseConnection
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = new PDO(
                "mysql:host=mariadb;dbname=". $_ENV["DATABASE_NAME"],
                $_ENV["DATABASE_USER"],
                $_ENV["DATABASE_PASSWORD"],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$instance;
    }
}