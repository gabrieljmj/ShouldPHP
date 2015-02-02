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
use Gabrieljmj\Should\Assert\TheProperty\Be\Equal;

class Be extends AbstractPropertyCondition
{
    public function equal($value, $message = null)
    {
        $instance = new Equal($this->class, $this->property, $value);
        $instance->setMessage($message);
        $this->addAssert($instance);
    }

    public function visible($as, $message = null)
    {
        $instance = new VisibileAs($this->class, $this->property, $as);
        $instance->setMessage($message);
        $this->addAssert($instance);
    }
}