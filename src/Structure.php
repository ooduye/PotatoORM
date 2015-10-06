<?php

namespace Yemisi;

/**
 * Interface ModelInterface
 * @package Yemisi
 */
interface Structure
{
    /**
     * @return mixed
     */
    public static function getAll();

    /**
     * @param $id
     * @return mixed
     */
    public static function find($id);

    /**
     * @return mixed
     */
    public function save();

    /**
     * @param $id
     * @return mixed
     */
    public static function destroy($id);
}