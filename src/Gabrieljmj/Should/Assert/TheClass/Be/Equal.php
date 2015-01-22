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

use Gabrieljmj\Should\Assert\TheClass\AbstractClassAssert;

class Equal extends AbstractClassAssert
{
    /**
     * @var object
     */
    private $arg2;
    
    /**
     * @param object $class
     * @param object $arg2
     */
    public function __construct($class, $arg2)
    {
        if (!is_object($class) || !is_object($arg2)) {
            throw new \InvalidArgumentException('Both arguments must be object');
        }
        
        parent::__construct($class);
        $this->arg2 = $arg2;
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if an instance of some class is equal other';
    }

    /**
     * Returns teh fail description
     * Null case in case of success
     *
     * @return string|null
     */
    public function getFailMessage()
    {
        $class = $this->classToStr($this->class);
        $arg2 = $this->classToStr($this->arg2);
        return $this->execute() ? null : 'The instance of ' . $class . ' is not equal to the another instance of ' . $arg2;
    }

    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute()
    {
        return $this->class == $this->arg2;
    }
}