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

use Gabrieljmj\Should\Condition\TheMethod\AbstractMethodCondition;
use Gabrieljmj\Should\Assert\TheMethod\Have\ArgumentsEqual;

class Have extends AbstractMethodCondition
{
    public function argumentsEqual(array $args, $message = null)
    {
        $instance = new ArgumentsEqual($this->class, $this->method, $args);
        $instance->setMessage($message);
        $this->addAssert($instance);
    }
}