<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/14/15
 * Time: 3:56 PM
 */

namespace Yemisi\Test;

use Mockery;
use Yemisi\Model;

/**
 * Class ModelDeleteStub
 * @package Yemisi\Test
 */
class ModelDeleteStub extends Model {

    /**
     * @param $id
     * @return bool
     *
     * Stub for testing delete model to database
     */
    public static function destroy($id)
    {
        return true;
    }

}