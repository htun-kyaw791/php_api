<?php

namespace Core;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
    private static $instance = null;

    public static function getConnection()
    {
        if (self::$instance === null) {

        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->load();

        $dbConfig = [
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_NAME'],
            'username' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            // 'socket' => $_ENV['DB_SOCKET'],
            // ;unix_socket={$dbConfig['socket']}

        ];

            try {
                self::$instance = new PDO(
                    "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']}",
                    $dbConfig['username'],
                    $dbConfig['password']
                );
                
                
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
