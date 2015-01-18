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
use \InvalidArgumentException;

class Equal extends AbstractAssert
{
    /**
     * @var object
     */
    private $arg1;
    
    /**
     * @var object
     */
    private $arg2;
    
    /**
     * @param object $arg1
     * @param object $arg2
     */
    public function __construct($arg1, $arg2)
    {
        if (!is_object($arg1) || !is_object($arg2)) {
            throw new InvalidArgumentException('Both arguments must be object');
        }
        
        $this->arg1 = $arg1;
        $this->arg2 = $arg2;
    }

    public function getTestedElement()
    {
        return get_class($this->arg1);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if an instance of some class is equal other';
    }

    public function getFailMessage()
    {
        return $this->execute() ? null : 'The instance of ' . get_class($this->arg1) . ' is not equal to the another instance of ' . get_class($this->arg2);
    }

    /**
     * @return boolean
     */
    public function execute()
    {
        return $this->arg1 == $this->arg2;
    }
}