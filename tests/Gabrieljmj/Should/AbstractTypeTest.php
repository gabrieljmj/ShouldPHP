<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Test\Gabrieljmj\Should;

use Gabrieljmj\Should\ShouldInterface;

abstract class AbstractTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testGettingThePropertyShouldReallyReturnsAnInstanceOfShouldInterface()
    {
        $i = $this->getInstance();

        $this->assertTrue($i->should instanceof ShouldInterface);
    }

    public function testShouldPropertyIsTheCorrespondentShouldClass()
    {
        $i = $this->getInstance();

        $this->assertTrue(is_a($i->should, $this->getShouldClassName()));
    }

    abstract protected function getInstance();

    abstract protected function getShouldClassName();
}