<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Gabrieljmj\Should\Assert;

use Gabrieljmj\Should\Assert\AssertInterface;
use Gabrieljmj\Should\Exception\AssertException;

abstract class AbstractAssert implements AssertInterface
{
    protected $message;

    protected $failMsg;
    
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    public function getMessage()
    {
        return $this->message;
    }
}