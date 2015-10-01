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

    protected $db;

    /**
     *
     */
    public function __construct()
    {
        $this->loadDotEnv();
        $this->engine   = getenv('DB_ENGINE');
        $this->name     = getenv('DB_NAME');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
    }

    /**
     *
     */
    private function loadDotEnv(){
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();
    }

    /**
     * @return \PDO
     */
    protected function createConnection()
    {
        try {
            return new PDO($this->engine . ":host=localhost;dbname=" . $this->name, $this->username, $this->password);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}