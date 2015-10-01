<?php

namespace Yemisi;

/**
 * Interface ModelInterface
 * @package Yemisi
 */
interface ModelInterface
{
    public function getAll();

    public function find($id);

    public function save();

    public function destroy($id);
}