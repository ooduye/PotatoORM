<?php

namespace Yemisi;

/**
 * Interface ModelInterface
 * @package Yemisi
 */
interface ModelInterface
{
    public static function getAll();

    public static function find($id);

    public static function save();

    public static function destroy($id);
}