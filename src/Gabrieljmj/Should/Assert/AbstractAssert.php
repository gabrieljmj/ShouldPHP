<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert;

use Gabrieljmj\Should\Assert\AssertInterface;
use Gabrieljmj\Should\Exception\AssertException;

abstract class AbstractAssert implements AssertInterface
{
    /**
     * Custom message in case of fail
     *
     * @var string
     */
    protected $message;
    
    /**
     * Sets the custom message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    /**
     * Returns a custom message in case of fail
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    protected function classToStr($class)
    {
        return is_object($class) ? get_class($class) : $class;
    }
}