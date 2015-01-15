<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Gabrieljmj\Should\Condition\TheProperty;

use Gabrieljmj\Should\Condition\AbstractCondition;

abstract class AbstractPropertyCondition extends AbstractCondition
{
    protected $class;

    protected $property;

    public function __construct($class, $property)
    {
        $this->class = $class;
        $this->property = $property;
    }
}