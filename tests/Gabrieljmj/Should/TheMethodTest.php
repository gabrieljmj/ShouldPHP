<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Test\Gabrieljmj\Should;

use Gabrieljmj\Should\ShouldMethod;
use Gabrieljmj\Should\TheMethod;

class TheMethodTest extends AbstractTypeTest
{
    protected function getInstance()
    {
        $should = new ShouldMethod('class', 'method');
        return new TheMethod($should);
    }

    protected function getShouldClassName()
    {
        return '\Gabrieljmj\Should\ShouldMethod';
    }
}