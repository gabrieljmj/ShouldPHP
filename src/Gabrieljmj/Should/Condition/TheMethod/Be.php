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
use Gabrieljmj\Should\Assert\TheMethod\Be\VisibleAs;

class Be extends AbstractMethodCondition
{
    /**
     * Tests if the visibility of determined method is public, or protected, or private
     *
     * @param integer     $as
     * @param string|null $message
     */
    public function visible($as, $message = null)
    {
        $instance=  new VisibleAs($this->class, $this->method, $as);
        $instance->setMessage($message);
        $this->addAssert($instance);
    }
}