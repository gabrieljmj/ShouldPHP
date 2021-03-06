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

use Gabrieljmj\Should\Assert\TheClass\Be\Equal;

class EqualTest extends \PHPUnit_Framework_TestCase
{
    public function testGetterForMessageRetrusnTheCorrectValue()
    {
        $message = 'Failure!';
        $instance = $this->getSuccessInstance();
        $instance->setMessage($message);

        $this->assertEquals($instance->getMessage(), $message);
    }

    public function testGettingTheTestedElement()
    {
        $assert = $this->getSuccessInstance();

        $this->assertEquals('stdClass', $assert->getTestedElement($assert));
    }

    public function testExecutingWithNotEqualsReturnsFalseBoolean()
    {
        $i = $this->getFailInstance();

        $this->assertFalse($i->execute());
    }

    public function testExecutingWithEqualsReturnsTrueBoolean()
    {
        $assert = $this->getSuccessInstance();

        $this->assertTrue($assert->execute());
    }

    public function testGetterForFailureMessageReturnsNullWhenTheTestPass()
    {
        $instance = $this->getSuccessInstance();

        $this->assertNull($instance->getFailMessage());
    }

    public function testGetterForFailureMessageReturnCorrectValueWhenNotPass()
    {
        $i = $this->getFailInstance();

        $this->assertEquals('The instance of stdClass is not equal to the another instance of stdClass', $i->getFailMessage());
    }

    private function getSuccessInstance()
    {
        return new Equal(new \stdClass, new \stdClass);
    }

    private function getFailInstance()
    {
        $i = new \stdClass;
        $i->foo = 'bar';

        return new Equal(new \stdClass, $i);
    }
}