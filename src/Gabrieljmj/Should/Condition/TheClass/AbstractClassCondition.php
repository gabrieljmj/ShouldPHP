<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Condition\TheClass;

use Gabrieljmj\Should\Condition\AbstractCondition;

abstract class AbstractClassCondition extends AbstractCondition
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }
}