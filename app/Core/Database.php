<?php
namespace Core;

use PDO;

class Database {
    protected static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            $config = require __DIR__ . '/../../config/config.php';
            self::$connection = new PDO(
                "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8",
                $config['db_user'],
                $config['db_pass']
            );
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }
}

