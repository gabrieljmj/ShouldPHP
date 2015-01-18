<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Condition\TheParameter;

use Gabrieljmj\Should\Condition\AbstractCondition;

abstract class AbstractParameterCondition extends AbstractCondition
{
    protected $class;

    protected $method;

    protected $parameter;

    public function __construct($class, $method, $parameter)
    {
        $this->class = $class;
        $this->method = $method;
        $this->parameter = $parameter;
    }
}