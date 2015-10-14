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
abstract class Connection
{

    protected static $engine;
    protected static $name;
    protected static $username;
    protected static $password;

    /**
     * Setting the environment variables
     */
    public function __construct()
    {
        $this->loadDotEnv();
        self::$engine   = getenv('DB_ENGINE');
        self::$name     = getenv('DB_NAME');
        self::$username = getenv('DB_USERNAME');
        self::$password = getenv('DB_PASSWORD');
    }

    /**
     * Method to load environment variables
     */
    public function loadDotEnv(){
        $dotenv = new Dotenv(__DIR__ . '/../../');
        $dotenv->load();
    }

    /**
     * @return PDO|string
     *
     * Method to create PDO connection
     */
    public static function createConnection()
    {
        try {
            return new PDO(self::$engine . ":host=localhost;dbname=" . self::$name, self::$username, self::$password);
        } catch (PDOException $e) {
            return "Connection to database failed: " . $e->getMessage();
        }
    }
}