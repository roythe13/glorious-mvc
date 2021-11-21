<?php

namespace App\Config;

class Database
{
    private static ?\PDO $pdo = null;

    public static function connect(string $env = "test"): \PDO
    {
        if (self::$pdo == null) {
            // create new PDO
            $config = self::config();
            self::$pdo = new \PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password']
            );
        }

        return self::$pdo;
    }

    private static function config(): array
    {
        return [
            "database" => [
                "test" => [
                    "url" => "mysql:host=localhost:3306;dbname=test_php_login_management",
                    "username" => "root",
                    "password" => "sussyballs"
                ],
                "prod" => [
                    "url" => "mysql:host=localhost:3306;dbname=project_php_login_management",
                    "username" => "root",
                    "password" => "sussyballs"
                ]
            ]
        ];
    }
}
