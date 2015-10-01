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
    public function getAll()
    {
        try {
            return $this->createConnection()->query("SELECT * FROM Tasks")->fetchAll();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function find($id)
    {
        $stmt = $this->createConnection()->prepare("Select * from Tasks where id = ?");
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    /**
     *
     */
    public function save()
    {

    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $count = $this->createConnection()->prepare("DELETE FROM Tasks WHERE id = ?");
        $count->execute(array($id));
    }
}