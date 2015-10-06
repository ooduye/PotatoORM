<?php

namespace Yemisi;

use PDO;
use PDOException;
use Yemisi\Inflect;

/**
 * Class Model
 * @package Yemisi
 */
abstract class Model extends Connection implements Structure
{

    private static $className;
    private static $tableName;
    private static $properties = [];

    /**
     * Getting the class name and table name to be used ny this class
     */
    public function __construct()
    {
        parent::__construct();
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
     */
    public static function getProperties()
    {
        return self::$properties;
    }

    /**
     * @return string
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
     */
    public static function getTableName()
    {
       return Inflect::pluralize(self::from_camel_case());
    }

    /**
     * @return array|string
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
     * Method to either save properties gotten from magic method
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
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
        return $result->rowCount();
    }

    /**
     * @param $id
     * @param $properties
     * @return string
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