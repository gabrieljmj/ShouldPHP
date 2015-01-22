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

use Gabrieljmj\Should\Assert\TheClass\Be\Instance;

class InstanceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetterForMessageRetrusnTheCorrectValue()
    {
        $message = 'Failure!';
        $instance = $this->getSuccessInstance();
        $instance->setMessage($message);

        $this->assertEquals($instance->getMessage(), $message);
    }
    
    public function testGettingTestedElement()
    {
        $assert = $this->getSuccessInstance();

        $this->assertEquals('\Test\Gabrieljmj\Should\Assert\Foo', $assert->getTestedElement($assert));
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

    public function testPassTestingIfIsInstanceOfAnInterface()
    {
        $i = new Instance('\Test\Gabrieljmj\Should\Assert\Foo', '\Serializable');

        $this->assertTrue($i->execute());
    }

    public function testGetterForFailureMessageReturnCorrectValueWhenNotPass()
    {
        $i = $this->getFailInstance();

        $this->assertEquals('\Test\Gabrieljmj\Should\Assert\Foo is not instance of \stdClass', $i->getFailMessage());
    }

    private function getSuccessInstance()
    {
        return new Instance('\Test\Gabrieljmj\Should\Assert\Foo', '\Test\Gabrieljmj\Should\Assert\Foo');
    }

    private function getFailInstance()
    {
        return new Instance('\Test\Gabrieljmj\Should\Assert\Foo', '\stdClass');
    }
}