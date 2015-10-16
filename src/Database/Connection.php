<?php

namespace Yemisi\Database;

use PDO;
use PDOException;
use Dotenv\Dotenv;

/**
 * Class Connection
 * @package Yemisi
 *
 */
class Connection
{

    protected static $engine;
    protected static $host;
    protected static $name;
    protected static $username;
    protected static $password;
    protected static $options;

    /**
     * Setting the environment variables
     */
    public static function getEnv()
    {
        static::loadDotEnv();
        self::$engine   = getenv('DB_ENGINE');
        self::$host     = getenv('DB_HOST');
        self::$name     = getenv('DB_NAME');
        self::$username = getenv('DB_USERNAME');
        self::$password = getenv('DB_PASSWORD');
        self::$options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
    }

    /**
     * Method to load environment variables
     */
    public static function loadDotEnv(){
        $dotenv = new Dotenv($_SERVER['DOCUMENT_ROOT']);
        $dotenv->load();
    }

    /**
     * @return PDO|string
     *
     * Method to create PDO connection
     */
    public static function createConnection()
    {
        static::getEnv();
        try {
            return new PDO(self::$engine . ":host=". self::$host .";dbname=" . self::$name, self::$username, self::$password, self::$options);
        } catch (PDOException $e) {
            return "Connection to database failed: " . $e->getMessage();
        }
    }
}