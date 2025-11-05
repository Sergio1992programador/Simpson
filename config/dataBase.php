<?php

class Database
{
    private static $host = "localhost";
    private static $db_name = "simpson_db";
    private static $username = "root";
    private static $password = "";

    public static function getConnection()
    {
        $conn = null;
        try {
            $conn = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                self::$username,
                self::$password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
        return $conn;
    }
}


