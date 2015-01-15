<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Condition\TheProperty;

use Gabrieljmj\Should\Condition\TheProperty\AbstractPropertyCondition;
use Gabrieljmj\Should\Assert\TheProperty\Be\Equals;

class Be extends AbstractPropertyCondition
{
    public function equals($value, $message = null)
    {
        $instance = new Equals($this->class, $this->property, $value);
        $instance->setMessage($message);
        $this->addAssert($instance);
    }
}