<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheClass\Have;

use Gabrieljmj\Should\Assert\TheClass\AbstractClassAssert;

class TheMethod extends AbstractClassAssert
{
    /**
     * @var string
     */
    private $method;
    
    /**
     * @param string|object $class
     * @param string        $method
     */
    public function __construct($class, $method)
    {
        parent::__construct($class);
        $this->method = $method;
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if a class has certain method';
    }

    /**
     * Creates the fail message
     *
     * @return string
     */
    protected function createFailMessage()
    {
        $class = $this->classToStr($this->class);
        return 'The class ' . $class . ' has not the method ' . $this->method;
    }

    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute()
    {
        $ref = new \ReflectionClass($this->class);
        return $ref->hasMethod($this->method);
    }
}