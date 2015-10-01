<?php

namespace Yemisi;

use PDOException;

/**
 * Class Model
 * @package Yemisi
 */
class Model extends Connection implements ModelInterface
{

    /**
     * @return array
     */
    public static function getAll()
    {
        try {
            return self::createConnection()->query("SELECT * FROM Tasks")->fetchAll();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return array
     */
    public static function find($id)
    {
        $stmt = self::createConnection()->prepare("Select * from Tasks where id = ?");
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    /**
     *
     */
    public static function save()
    {

    }

    /**
     * @param $id
     */
    public static function destroy($id)
    {
        $count = self::createConnection()->prepare("DELETE FROM Tasks WHERE id = ?");
        $count->execute(array($id));
    }
}