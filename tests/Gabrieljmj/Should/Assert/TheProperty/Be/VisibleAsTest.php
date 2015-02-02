<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Test\Gabrieljmj\Should\Assert\TheProperty\Be;

use Gabrieljmj\Should\Assert\TheProperty\Be\VisibleAs;
use Gabrieljmj\Should\Options\Visibility;

class VsibileAsTest extends \PHPUnit_Framework_TestCase
{
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

    public function testCheckingPublicWorks()
    {
        $instance = new VisibleAs('\Test\Gabrieljmj\Should\Assert\Foo', 'public', Visibility::AS_PUBLIC);

        $this->assertTrue($instance->execute());
    }

    public function testCheckingProtectedWorks()
    {
        $instance = new VisibleAs('\Test\Gabrieljmj\Should\Assert\Foo', 'protected', Visibility::AS_PROTECTED);

        $this->assertTrue($instance->execute());
    }

    public function testCheckingPrivateWorks()
    {
        $instance = new VisibleAs('\Test\Gabrieljmj\Should\Assert\Foo', 'private', Visibility::AS_PRIVATE);

        $this->assertTrue($instance->execute());
    }

    public function testCheckingPrivatePassingPublicFails()
    {
        $instance = new VisibleAs('\Test\Gabrieljmj\Should\Assert\Foo', 'public', Visibility::AS_PRIVATE);

        $this->assertFalse($instance->execute());
    }

    public function getSuccessInstance()
    {
        return new VisibleAs('\Test\Gabrieljmj\Should\Assert\Foo', 'public', Visibility::AS_PUBLIC);
    }

    public function getFailInstance()
    {
        return new VisibleAs('\Test\Gabrieljmj\Should\Assert\Foo', 'protected', Visibility::AS_PRIVATE);
    }
}