<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheProperty\Be;

use Gabrieljmj\Should\Assert\AbstractAssert;

class Equal extends AbstractAssert
{
    private $class;

    private $property;

    private $value;

    public function __construct($class, $property, $value)
    {
        $this->class = $class;
        $this->property = $property;
        $this->value = $value;
    }

    public function execute()
    {
        $ref = new \ReflectionClass($this->class);

        if ($ref->hasProperty($this->property)) {
            if (!$ref->getProperty($this->property)->isPublic()) {
                $properties = $ref->getDefaultProperties();

                return $this->value == $properties[$this->property];
            }

            return $this->value == $ref->getProperty($this->property)->getValue();
        }

        return false;
    }

    public function getTestedElement()
    {
        $class = is_object($this->class) ? get_class($this->class) : $this->class;
        return $class . '::$' . $this->property;
    }

    public function getDescription()
    {
        return 'Tests if a class has a property with a certain value. If the property is not public, the default value will be used.';
    }

    public function getFailMessage()
    {
        $class = is_object($this->class) ? get_class($this->class) : $this->class;
        return $this->execute() ? null : 'The property ' . $this->property . ' of the class ' . $class . ' is not equal to ' . print_r($this->value, true);
    }
}