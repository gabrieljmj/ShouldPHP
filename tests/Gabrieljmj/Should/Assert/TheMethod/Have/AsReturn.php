<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */

namespace Test\Gabrieljmj\Should\Assert\TheMethod\Have;

use Gabrieljmj\Should\Assert\TheMethod\Have\AsReturn;

class AsReturnTest extends \PHPUnit_Framework_TestCase
{
    public function testExecutingWithInvalidValueReturnsFalseBoolean()
    {
        $i = $this->getFailInstance();

        $this->assertFalse($i->execute());
    }

    public function testExecutingWithValidValueReturnsTrueBoolean()
    {
        $i = $this->getSuccessInstance();

        $this->assertTrue($i->execute());
    }

    public function testGetterForFailureMessageReturnsNullWhenTheTestPass()
    {
        $i = $this->getSuccessInstance();

        $this->assertNull($i->getFailMessage());
    }

    public function testGettingTestedElement()
    {
        $i = $this->getSuccessInstance();

        $this->assertEquals('\Test\Gabrieljmj\Should\Assert\Foo::getBar', $i->getTestedElement());
    }

    private function getSuccessInstance()
    {
        return new AsReturn('\Test\Gabrieljmj\Should\Assert\Foo', 'getBar', 'bar', []);
    }

    private function getFailInstance()
    {
        return new AsReturn('\Test\Gabrieljmj\Should\Assert\Foo', 'getBar', 'baz', []);
    }
}