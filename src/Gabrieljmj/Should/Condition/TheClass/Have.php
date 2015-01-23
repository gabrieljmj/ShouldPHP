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

use Gabrieljmj\Should\Condition\TheClass\AbstractClassCondition;
use Gabrieljmj\Should\Assert\TheClass\Have\TheProperty;
use Gabrieljmj\Should\Assert\TheClass\Have\TheMethod;

class Have extends AbstractClassCondition
{
    public function theProperty($property, $message = null)
    {
        $instance = new TheProperty($this->class, $property);
        $instance->setMessage($message);
        $this->addAssert($instance);
    }

    public function theMethod($method, $message = null)
    {
        $instance = new TheMethod($this->class, $method);
        $instance->setMessage($message);
        $this->addAssert($instance);
    }
}