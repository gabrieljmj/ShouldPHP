<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Test\Gabrieljmj\Should;

use Gabrieljmj\Should\ShouldProperty;
use Gabrieljmj\Should\TheProperty;
use Test\Gabrieljmj\Should\AbstractTypeTest;

class ThePropertyTest extends AbstractTypeTest
{
    protected function getInstance()
    {
        $should = new ShouldProperty('class', 'property');
        return new TheProperty($should);
    }

    protected function getShouldClassName()
    {
        return '\Gabrieljmj\Should\ShouldProperty';
    }
}