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

use Test\Gabrieljmj\Should\Assert\AbstractAssertTest;
use Gabrieljmj\Should\Assert\TheMethod\Have\AsReturn;

class AsReturnTest extends AbstractAssertTest
{
    public function testGettingTestedElement()
    {
        $i = $this->getSuccessInstance();

        $this->assertEquals('\Test\Gabrieljmj\Should\Assert\Foo::getBar', $i->getTestedElement());
    }

    protected function getSuccessInstance()
    {
        return new AsReturn('\Test\Gabrieljmj\Should\Assert\Foo', 'getBar', 'bar', []);
    }

    protected function getFailureInstance()
    {
        return new AsReturn('\Test\Gabrieljmj\Should\Assert\Foo', 'getBar', 'baz', []);
    }

    protected function getFailureMessage()
    {
        return 'The return of the method \Test\Gabrieljmj\Should\Assert\Foo is not equal the expected: baz';
    }
}