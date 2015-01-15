<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Test\Gabrieljmj\Should;

use Gabrieljmj\Should\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testSettingTheArray()
    {
        $arr = ['1', 'foo', 'bar'];
        $collection = new Collection($arr);
    
        $this->assertEquals($arr, $collection->toArray());
    }
}