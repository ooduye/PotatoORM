<?php

namespace Yemisi;

use PDO;
use PDOException;
use Dotenv\Dotenv;

/**
 * Class Connection
 * @package Yemisi
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
        self::loadDotEnv();
        self::$engine   = getenv('DB_ENGINE');
        self::$name     = getenv('DB_NAME');
        self::$username = getenv('DB_USERNAME');
        self::$password = getenv('DB_PASSWORD');
    }

    /**
     *
     */
    private static function loadDotEnv(){
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();
    }

    /**
     * @return \PDO
     */
    protected static function createConnection()
    {
        try {
            return new PDO(self::$engine . ":host=localhost;dbname=" . self::$name, self::$username, self::$password);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}