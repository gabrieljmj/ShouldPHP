<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Test\Gabrieljmj\Should\Assert\TheClass\Be;

use Test\Gabrieljmj\Should\Assert\AbstractAssertTest;
use Gabrieljmj\Should\Assert\TheClass\Be\Equal;

class EqualTest extends AbstractAssertTest
{
    public function testExecutingWithNotEqualsReturnsFalseBoolean()
    {
        $assert = $this->getFailureInstance();

        $this->assertFalse($assert->execute());
    }

    public function testExecutingWithEqualsReturnsTrueBoolean()
    {
        $assert = $this->getSuccessInstance();

        $this->assertTrue($assert->execute());
    }

    protected function getSuccessInstance()
    {
        $obj1 = new \stdClass;
        $obj2 = new \stdClass;
        return new Equal($obj1, $obj2);
    }

    protected function getFailureInstance()
    {
        $obj1 = new \stdClass;
        $obj2 = new \stdClass;
        $obj2->foo = 'bar';
        return new Equal($obj1, $obj2);
    }

    protected function getFailureMessage()
    {
        return 'The instance of stdClass is not equal to the another instance of stdClass';
    }
}