<?php

use Mockery\Mock;
use Yemisi\Model;
use Yemisi\Test\ModelStub;

/**
 * Class DatabaseModelTest
 */
class DatabaseModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for property manipulation
     */
    public function testPropertiesManipulation()
    {
        $model = new ModelStub();
        $model->name = 'foo';
        $this->assertEquals('foo', $model->name);
        $this->assertTrue(isset($model::getProperties()['name']));
    }

    /**
     * Test the getTableName function
     */
    public function testTableName()
    {
        $connection = Mockery::mock('Yemisi\Database\Connection');
        $model = Mockery::mock('Yemisi\Model');
        $model->shouldReceive('createConnection')
            ->once()
            ->andReturn($connection);
        $model = new ModelStub();
        $tableName = $model->getTableName();
        $this->assertEquals('test_model_stubs', $tableName);
        $this->assertNotEquals('test_model_stub', $tableName);
    }

    /**
     * Test if properties can be manipulated
     */
    public function testPropertiesCanBeManipulated()
    {
        $model = new ModelStub();
        $model->name = "bar";
        $this->assertEquals('bar', $model->name);
        $this->assertNotEquals('foo', $model->name);
        $this->assertNotNull($model->name);
        $model = new ModelStub();
        $model->email = 'foo@example.com';
        $model->password = 'bar';
        $model->name = 'FooBar';
        $this->assertArrayHasKey('email', $model->getProperties());
        $this->assertNotEquals('foobar', $model->name);
        $this->assertNotContains('foobar', $model->getProperties());
        $this->assertArrayHasKey('name', $model->getProperties());
        $this->assertTrue(isset($model->getProperties()['name']));
        unset($model->email);
        $this->assertFalse(isset($model->email));
    }

    /**
     * Test new instances of properties can be created
     */
    public function testNewInstanceCreatesInstanceWithoutProperties()
    {
        $model = new ModelStub();
        $this->assertNotEmpty($model->getProperties());
        $this->assertArrayNotHasKey('id', $model->getProperties());
    }

    /**
     * Test the find function
     */
    public function testModelCanBeFound()
    {
        $mock = Mockery::mock('Yemisi\Test\ModelFindStub');
        $mock->shouldReceive('find')
            ->with(1)
            ->andReturn('foo');
    }

    /**
     * Test the getAll function
     */
    public function testModelCanGetAll()
    {
        $rows = ["name" => 'yemisi', "age" => "10"];
        $mock = Mockery::mock('Yemisi\Test\ModelStub');
        $mock->shouldReceive('getAll')->once()->andReturn($rows);
        $this->assertEquals($mock->getAll(), ["name" => 'yemisi', "age" => "10"]);
    }

    /**
     * Test the destroy function
     */
    public function testModelCanBeDeleted()
    {
        $mock = Mockery::mock('Yemisi\Test\ModelDeleteStub');
        $mock->shouldReceive('destroy')
            ->with(1)
            ->once()
            ->andReturn(true);
    }

    /**
     * Test the update function
     */
    public function testModelCanBeUpdated()
    {
        $properties = ["name" => 'yemisi', "age" => "10"];
        $result = true;
        $mock = Mockery::mock('ModelStub');
        $mock->shouldReceive('update')->with(1, $properties)->andReturn($result);
        $this->assertEquals($mock->update(1, $properties), true);
    }

    /**
     * Test the save function
     */
    public function testModelCanBeCreated()
    {
        $model = new ModelSaveStub();
        $model->task = "Sleep";
        $model->description = "Sleep at 10pm";
        $properties = $model->getProperties();
        $this->assertArrayHasKey('task', $properties);
        $this->assertTrue($model->save());
        $this->assertNotEmpty($model->getProperties());
    }

}


/**
 * Class ModelSaveStub
 * @package Yemisi\Test
 *
 * Stub for testing saving a model to database
 */
class ModelSaveStub extends Model {

    protected $properties = [];
    public function save()
    {
        return true;
    }

}