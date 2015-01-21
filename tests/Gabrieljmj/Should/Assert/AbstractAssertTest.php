<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Test\Gabrieljmj\Should\Assert;

use Gabrieljmj\Should\Assert\AssertInterface;

abstract class AbstractAssertTest extends \PHPUnit_Framework_TestCase
{
    protected function assertPreConditions()
    {
        $this->assertTrue($this->getSuccessInstance() instanceof AssertInterface);
        $this->assertTrue($this->getFailureInstance() instanceof AssertInterface);
        $this->assertTrue($this->getSuccessInstance()->execute());
        $this->assertFalse($this->getFailureInstance()->execute());
    }

    public function testGetterForMessageRetrusnTheCorrectValue()
    {
        $message = 'Failure!';
        $instance = $this->getSuccessInstance();
        $instance->setMessage($message);

        $this->assertEquals($instance->getMessage(), $message);
    }

    public function testGetterForFailureMessageReturnsNullWhenTheTestPass()
    {
        $instance = $this->getSuccessInstance();

        $this->assertNull($instance->getFailMessage());
    }

    public function testGetterForFailureMessageReturnsTheCorrectValueWhenTheTestDoesNotPass()
    {
        $instance = $this->getFailureInstance();

        $this->assertEquals($this->getFailureMessage(), $instance->getFailMessage());
    }

    abstract protected function getSuccessInstance();

    abstract protected function getFailureInstance();

    abstract protected function getFailureMessage();
}