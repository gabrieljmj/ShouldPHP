<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Test\Gabrieljmj\Should;

use Gabrieljmj\Should\ShouldMethod;
use Gabrieljmj\Should\Condition\TheMethod\Have;
use Gabrieljmj\Should\Condition\TheMethod\Be;
use Gabrieljmj\Should\Assert\TheMethod\Have\ArgumentsEqual;

class ShouldMethodTest extends \PHPUnit_Framework_TestCase
{
    public function testSettingPropertiesBeAndHave()
    {
        $class = '\Test\Gabrieljmj\Should\Assert\Foo';
        $method = 'getBar';
        $should = new ShouldMethod($class, $method);
        $have = new Have($class, $method);
        $be = new Be($class, $method);

        $this->assertAttributeEquals($have, 'have', $should);
        $this->assertAttributeEquals($be, 'be', $should);
    }

    public function testAddingAssertTheMethodSpecifiedReturnsCorrectly()
    {
        $class = '\Test\Gabrieljmj\Should\Assert\Foo';
        $method = 'getBar';
        $args = ['arg1'];
        $should = new ShouldMethod($class, $method);
        $should->have->argumentsEqual($args);
        $assert = new ArgumentsEqual($class, $method, $args);
        $assertList = $should->getAssertList();

        $this->assertTrue(in_array($assert, $assertList));
    }
}