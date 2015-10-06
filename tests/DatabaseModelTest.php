<?php

use Mockery\Mock;
use Yemisi\Test\Task;

class DatabaseModelTest extends \PHPUnit_Framework_TestCase
{
    public function testAttributeManipulation()
    {
        $model = new Task();
        $model->name = 'foo';
        $this->assertEquals('foo', $model->name);
        $this->assertTrue(isset($model::getProperties()['name']));
    }

    public function testTableName()
    {
        $model = new Task();
        $table = $model->getTableName();
        $this->assertEquals('test_tasks', $table);
    }


}


