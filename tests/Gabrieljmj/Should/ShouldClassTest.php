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

use Gabrieljmj\Should\ShouldClass;
use Gabrieljmj\Should\Condition\TheClass\Have;
use Gabrieljmj\Should\Condition\TheClass\Be;
use Gabrieljmj\Should\Assert\TheClass\Be\Equals;
use Gabrieljmj\Should\Assert\TheClass\Be\Instance;

class ShouldClassTest extends \PHPUnit_Framework_TestCase
{
    public function testSettingPropertiesBeAndHave()
    {
        $class = '\stdClass';
        $should = new ShouldClass($class);
        $have = new Have($class);
        $be = new Be($class);

        $this->assertAttributeEquals($have, 'have', $should);
        $this->assertAttributeEquals($be, 'be', $should);
    }

    public function testAddingAssertTheMethodSpecifiedReturnsCorrectly()
    {
        $i = new \stdClass;
        $i2 = new \stdClass;
        $should = new ShouldClass($i);
        $should->be->equals($i2);
        $should->be->instance('\stdClass');
        $assert1 = new Equals($i, $i2);
        $assert2 = new Instance($i, '\stdClass');
        $assertList = $should->getAssertList();

        $this->assertTrue(in_array($assert1, $assertList));
        $this->assertTrue(in_array($assert2, $assertList));
    }
}