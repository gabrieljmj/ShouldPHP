<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Gabrieljmj\Should\Condition\TheClass;

use Gabrieljmj\Should\Condition\TheClass\AbstractClassCondition;
use Gabrieljmj\Should\Assert\TheClass\Be\Equals;
use Gabrieljmj\Should\Assert\TheClass\Be\Instance;

class Be extends AbstractClassCondition
{
    public function equals($arg, $message = null)
    {
        $Assert = new Equals($this->class, $arg);
        $Assert->setMessage($message);
        $this->addAssert($Assert);
    }
    
    public function instance($arg, $message = null)
    {
        $Assert = new Instance($this->class, $arg);
        $Assert->setMessage($message);
        $this->addAssert($Assert);
    }
}