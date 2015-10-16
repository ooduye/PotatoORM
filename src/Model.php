<?php

namespace Yemisi;

use PDO;
use PDOException;
use Yemisi\Inflect;
use Yemisi\Database\Connection;
use Yemisi\Structure\ModelStructure;

/**
 * Class Model
 * @package Yemisi
 */
abstract class Model extends Connection implements ModelStructure
{

    private static $className;
    private static $tableName;
    private static $properties = [];

    /**
     * Getting the class name and table name to be used ny this class
     */
    public function __construct()
    {
//        parent::__construct();
        self::$className = substr( get_called_class() , 7 );
        self::$tableName = static::getTableName();
    }

    /**
     * @param $property
     * @param $value
     */
    public function __set($property, $value)
    {
        self::$properties[$property] = $value;
    }


    /**
     * @param $property
     * @return mixed
     *
     * Magic method for getting the value of a property
     * whose name was just concocted from nowhere.
     */
    public function __get($property)
    {
        if(isset(self::$properties[$property])) {
            return self::$properties[$property];
        }
    }

    /**
     * @return array
     *
     * Method to get properties array
     */
    public static function getProperties()
    {
        return self::$properties;
    }

    /**
     * @return string
     *
     * Method to convert class name to camel case
     */
    public static function from_camel_case() {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', self::$className, $matches);

        $ret = $matches[0];

        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }

    /**
     * @return mixed
     *
     * Method to get the table name
     */
    public static function getTableName()
    {
       return Inflect::pluralize(self::from_camel_case());
    }

    /**
     * @return array|string
     *
     * Method to fetch all data from a table
     */
    public static function getAll()
    {
        $table = self::getTableName();
        try {
            return self::createConnection()->query("SELECT * FROM {$table}")->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return string|static
     *
     * Method to find a row in a table
     */
    public static function find($id)
    {
        $class = new static;
        $table = self::getTableName();
        try {
            $stmt = self::createConnection()->prepare("Select * FROM {$table} where id = ?");
            $stmt->execute(array($id));
            $data = $stmt->fetchAll();
            $class->doUpdate = $data[0]['id'];
            return $class;
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }


    /**
     * @return string
     *
     * Method to save properties to a table
     */
    public function save()
    {
        $properties = self::getProperties();

        if($this->doUpdate) {
            $id = $this->doUpdate;

            self::update($id, $properties);
        } else {
            $table = self::getTableName();
            $columns    = implode(',',array_keys($properties));
            $values     = "'" . implode("','", array_values($properties)) . "'";

            try {
                $result = self::createConnection()->query("INSERT INTO {$table}({$columns}) VALUES({$values})");
                return $result->rowCount();
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
    }

    /**
     * @param $id
     * @param $properties
     * @return string
     *
     * Method to update a row on a table
     */
    public static function update($id, $properties)
    {
        unset($properties['doUpdate']);

        $table = self::getTableName();

        $query = "UPDATE ".$table." SET ";
        $count = 0;
        foreach($properties as $key => $value) {
            $count++;
            $query .= "$key = '$value'";
            if($count < count($properties)) {
                $query .= ", ";
            }
        }
        $query .= " WHERE id = " . $id;

        try {
            $count = self::createConnection()->prepare($query);
            $count->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param $id
     * @return string
     *
     * Method to delete a row from a table
     */
    public static function destroy($id)
    {
        $table = self::getTableName();
        try {
            $count = self::createConnection()->prepare("DELETE FROM {$table} WHERE id = ?");
            $count->execute(array($id));
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $count->rowCount();
    }
}