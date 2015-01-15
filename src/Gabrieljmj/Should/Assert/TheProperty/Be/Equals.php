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

class Equals extends AbstractAssert
{
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

    public function getDescription()
    {
        return 'Tests if a class has a property with a certain value. If the property is not public, the default value will be used.';
    }

    public function getFailMessage()
    {
        return $this->execute() ? null : 'The property ' . $this->property . ' of the class ' . $this->class . ' is not equals ' . print_r($this->value, true);
    }
}