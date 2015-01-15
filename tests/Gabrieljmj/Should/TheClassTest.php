<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Test\Gabrieljmj\Should;

use Gabrieljmj\Should\ShouldClass;
use Gabrieljmj\Should\TheClass;
use Test\Gabrieljmj\Should\AbstractTypeTest;

class TheClassTest extends AbstractTypeTest
{
    protected function getInstance()
    {
        $should = new ShouldClass(new \stdClass);
        return new TheClass($should);
    }

    protected function getShouldClassName()
    {
        return '\Gabrieljmj\Should\ShouldClass';
    }
}