<?php

namespace Yemisi\Test;

use Yemisi\Inflect;

/**
 * Class InflectTest
 * @package Yemisi\Test
 */
class InflectTest extends \PHPUnit_Framework_TestCase {
    /**
     * @param $expected
     * @param $actual
     *
     * @dataProvider wordProvider
     */
    public function testWordInflection($actual, $expected )
    {
        $this->assertEquals($expected, Inflect::pluralize($actual));
    }
    public function wordProvider()
    {
        return [
            ['fish', 'fish'],
            ['child', 'children'],
            ['user', 'users'],
            ['goose', 'geese'],
            ['analysis', 'analyses']
        ];
    }
}