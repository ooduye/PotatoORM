<?php

namespace Yemisi;

use Dotenv\Dotenv;
use PDO;
use PDOException;


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
     *
     */
    public function __construct()
    {
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();
        self::$engine   = getenv('DB_ENGINE');
        self::$name     = getenv('DB_NAME');
        self::$username = getenv('DB_USERNAME');
        self::$password = getenv('DB_PASSWORD');
    }

    /**
     *
     */
    public function loadDotEnv(){
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();
    }

    /**
     * @return PDO|string
     */
    protected static function createConnection()
    {
        try {
            return new PDO(self::$engine . ":host=localhost;dbname=" . self::$name, self::$username, self::$password);
        } catch (PDOException $e) {
            return "Connection to database failed: " . $e->getMessage();
        }
    }
}