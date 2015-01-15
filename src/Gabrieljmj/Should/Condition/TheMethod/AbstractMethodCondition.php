<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Condition\TheMethod;

use Gabrieljmj\Should\Condition\AbstractCondition;

abstract class AbstractMethodCondition extends AbstractCondition
{
    protected $class;

    protected $method;

    public function __construct($class, $method)
    {
        $this->class = $class;
        $this->method = $method;
    }
}