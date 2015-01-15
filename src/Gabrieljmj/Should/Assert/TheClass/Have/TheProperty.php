<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Gabrieljmj\Should\Assert\TheClass\Have;

use Gabrieljmj\Should\Assert\AbstractAssert;

class TheProperty extends AbstractAssert
{
    /**
     * @var string
     */
    protected $class;
    
    /**
     * @var string
     */
    protected $property;
    
    /**
     * @param string|object $class
     * @param string        $property
     */
    public function __construct($class, $property)
    {
        $this->class = is_object($class) ? get_class($class) : $class;
        $this->property = $property;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if a class has certain property';
    }

    public function getFailMessage()
    {
        return $this->execute() ? null : 'The class ' . $this->class . ' has not the property ' . $this->property;
    }

    /**
     * @return boolean
     */
    public function execute()
    {
        $ref = new \ReflectionClass($this->class);
        return $ref->hasProperty($this->property);
    }
}