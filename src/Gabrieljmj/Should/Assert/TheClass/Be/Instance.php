<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheClass\Be;

use Gabrieljmj\Should\Assert\AbstractAssert;

class Instance extends AbstractAssert
{
    protected $arg1;
    
    protected $arg2;
    
    public function __construct($arg1, $arg2)
    {
        if (!is_object($arg1)) {
            throw new InvalidArgumentException('Both arguments must be object');
        }
        
        $this->arg1 = $arg1;
        $this->arg2 = $arg2;
    }

    public function getTestedElement()
    {
        return $this->arg1;
    }

    public function getDescription()
    {
        return 'Tests if the object is of this class or has this class as one of its parents';
    }

    public function execute()
    {
        return is_a($this->arg1, $this->arg2);
    }

    public function getFailMessage()
    {
        
    }
}