<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Test\Gabrieljmj\Should\Assert\TheClass\Have;

use Test\Gabrieljmj\Should\Assert\AbstractAssertTest;
use Gabrieljmj\Should\Assert\TheClass\Have\TheProperty;

class ThePropertyTest extends AbstractAssertTest
{
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

    protected function getSuccessInstance()
    {
        return new TheProperty('\Test\Gabrieljmj\Should\Assert\TheClass\Have\Foo', 'public');
    }

    protected function getFailureInstance()
    {
        return new TheProperty('\Test\Gabrieljmj\Should\Assert\TheClass\Have\Foo', 'invalid_property');
    }

    protected function getFailureMessage()
    {
        return 'The class \Test\Gabrieljmj\Should\Assert\TheClass\Have\Foo has not the property invalid_property';
    }

    protected function executingTestThatHaveToPass($property)
    {
        $instance = new TheProperty('\Test\Gabrieljmj\Should\Assert\TheClass\Have\Foo', $property);

        $this->assertTrue($instance->execute());
    }
}