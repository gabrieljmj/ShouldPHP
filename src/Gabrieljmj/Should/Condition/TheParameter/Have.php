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

use Gabrieljmj\Should\Condition\TheParameter\AbstractParameterCondition;
use Gabrieljmj\Should\Assert\TheParameter\Have\AsDefaultValue;

class Have extends AbstractParameterCondition
{
    public function asDefaultValue($value, $message = null)
    {
        $instance = new AsDefaultValue($this->class, $this->method, $this->parameter, $value);
        $instance->setMessage($message);
        $this->addAssert($instance);
    }

    public function acceptOnly($type, $message = null)
    {
        $instance = new AcceptOnly($this->class, $this->method, $this->parameter, $type);
        $instance->setMessage($message);
        $this->addAssert($instance);
    }
}