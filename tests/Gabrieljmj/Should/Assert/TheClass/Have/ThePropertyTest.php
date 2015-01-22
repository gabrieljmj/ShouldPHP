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

use Gabrieljmj\Should\Assert\TheClass\Have\TheProperty;

class ThePropertyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetterForMessageRetrusnTheCorrectValue()
    {
        $message = 'Failure!';
        $instance = $this->getSuccessInstance();
        $instance->setMessage($message);

        $this->assertEquals($instance->getMessage(), $message);
    }

    public function testPassWhenCheckAPublicProperty()
    {
        $this->executingTestThatHaveToPass('public');
    }

    public function testPassWhenCheckAPrivateProperty()
    {
        $this->executingTestThatHaveToPass('private');
    }

    public function testPassWhenCheckAProtectedProperty()
    {
        $this->executingTestThatHaveToPass('protected');
    }

    public function testGetterForFailureMessageReturnCorrectValueWhenNotPass()
    {
        $i = $this->getFailInstance();

        $this->assertEquals('The class \Test\Gabrieljmj\Should\Assert\Foo has not the property invalid_property', $i->getFailMessage());
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
        return new TheProperty('\Test\Gabrieljmj\Should\Assert\Foo', 'public');
    }

    private function getFailInstance()
    {
        return new TheProperty('\Test\Gabrieljmj\Should\Assert\Foo', 'invalid_property');
    }

    private function getFailureMessage()
    {
        return 'The class \Test\Gabrieljmj\Should\Assert\Foo has not the property invalid_property';
    }

    private function executingTestThatHaveToPass($property)
    {
        $instance = new TheProperty('\Test\Gabrieljmj\Should\Assert\Foo', $property);

        $this->assertTrue($instance->execute());
    }
}