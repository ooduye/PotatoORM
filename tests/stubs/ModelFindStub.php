<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/14/15
 * Time: 3:54 PM
 */

namespace Yemisi\Test;

use Mockery;
use Yemisi\Model;

/**
 * Class ModelFindStub
 * @package Yemisi\Test
 */
class ModelFindStub extends Model {

    /**
     * @param $id
     * @return string
     *
     * Stub for testing find model to database
     */
    public static function find($id)
    {
        return 'foo';
    }

}