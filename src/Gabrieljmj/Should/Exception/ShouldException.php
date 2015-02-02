<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */

namespace Gabrieljmj\Should\Exception;

use Gabrieljmj\Should\Exception\InvalidVisibilityTypeException;
use Gabrieljmj\Should\Exception\InvalidTypeHintingException;
use Gabrieljmj\Should\Exception\ClassDoesNotExistsException;
use Gabrieljmj\Should\Exception\PropertyDoesNotExistsException;
use Gabrieljmj\Should\Exception\MethodDoesNotExistsException;
use Gabrieljmj\Should\Exception\ParameterDoesNotExistsException;

class ShhouldException
{
    /**
     * @param string $type
     * @throws \Gabrieljmj\Should\Exception\InvalidVisibilityTypeException
     */
    public static function invalidVisibilityType($type)
    {
        InvalidVisibilityTypeException::trigger($type);
    }

    /**
     * @param string $type
     * @throws \Gabrieljmj\Should\Exception\InvalidTypeHintingException
     */
    public static function invalidTypeHinting($type)
    {
        InvalidTypeHintingException::trigger($type);
    }
    
    /**
     * @param string|object $class
     * @throws \Gabrieljmj\Should\Exception\ClassDoesNotExistsException
     */
    public static function classDoesNotExists($class)
    {
        ClassDoesNotExistsException::trigger($class);
    }
    
    /**
     * @param string|object $class
     * @param string        $property
     * @throws \Gabrieljmj\Should\Exception\PropertyDoesNotExistsException
     */
    public static function propertyDoesNotExists($class, $property)
    {
        PropertyDoesNotExistsException::trigger($class, $property);
    }

    /**
     * @param string|object $class
     * @param string        $method
     * @throws \Gabrieljmj\Should\Exception\MethodDoesNotExistsException
     */
    public statiC function methodDoesNotExistsException($class, $method)
    {
        MethodDoesNotExistsException::trigger($class, $method);
    }

    /**
     * @param string|object $class
     * @param string        $method
     * @param string        $parameter
     * @throws \Gabrieljmj\Should\Exception\ParameterDoesNotExistsException
     */
    public static function parameterDoesNotExists($class, $method, $parameter)
    {
        ParameterDoesNotExistsException::trigger($class, $method, $parameter);
    }

    /**
     * @param string|object $class
     * @return string
     */
    private function classToString($class)
    {
        return is_object($class) ? get_class($class) : $class;
    }
}