<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Test\Gabrieljmj\Should\Assert\TheClass\Have;

use Gabrieljmj\Should\Assert\TheClass\Have\TheMethod;

class TheMethodTest extends \PHPUnit_Framework_TestCase
{
    public function testGetterForMessageRetrusnTheCorrectValue()
    {
        $message = 'Failure!';
        $instance = $this->getSuccessInstance();
        $instance->setMessage($message);

        $this->assertEquals($instance->getMessage(), $message);
    }

    public function testPassWhenCheckAPublicMethod()
    {
        $this->executingTestThatHaveToPass('publicMethod');
    }

    public function testPassWhenCheckAPrivateMethod()
    {
        $this->executingTestThatHaveToPass('privateMethod');
    }

    public function testPassWhenCheckAProtectedMethod()
    {
        $this->executingTestThatHaveToPass('protectedMethod');
    }

    public function testGetterForFailureMessageReturnCorrectValueWhenNotPass()
    {
        $i = $this->getFailInstance();

        $this->assertEquals('The class \Test\Gabrieljmj\Should\Assert\Foo has not the method invalidMethod', $i->getFailMessage());
    }

    public function testExecutingWithInvalidValueReturnsFalseBoolean()
    {
        $i = $this->getFailInstance();

        $this->assertFalse($i->execute());
    }

    public function testGetterForFailureMessageReturnsNullWhenTheTestPass()
    {
        $i = $this->getSuccessInstance();

        $this->assertNull($i->getFailMessage());
    }

    public function testGettingTestedElement()
    {
        $i = $this->getSuccessInstance();

        $this->assertEquals('\Test\Gabrieljmj\Should\Assert\Foo', $i->getTestedElement());
    }

    private function getSuccessInstance()
    {
        return new TheMethod('\Test\Gabrieljmj\Should\Assert\Foo', 'getBar');
    }

    private function getFailInstance()
    {
        return new TheMethod('\Test\Gabrieljmj\Should\Assert\Foo', 'invalidMethod');
    }

    private function executingTestThatHaveToPass($property)
    {
        $instance = new TheMethod('\Test\Gabrieljmj\Should\Assert\Foo', $property);

        $this->assertTrue($instance->execute());
    }
}