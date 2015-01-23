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

class TheProperty extends AbstractClassAssert
{
    /**
     * @var string
     */
    private $property;
    
    /**
     * @param string|object $class
     * @param string        $property
     */
    public function __construct($class, $property)
    {
        parent::__construct($class);
        $this->property = $property;
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if a class has certain property';
    }

    /**
     * Creates the fail message
     *
     * @return string
     */
    protected function createFailMessage()
    {
        $class = is_object($this->class) ? get_class($this->class) : $this->class;
        return 'The class ' . $class . ' has not the property ' . $this->property;
    }

    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute()
    {
        $ref = new \ReflectionClass($this->class);
        return $ref->hasProperty($this->property);
    }
}