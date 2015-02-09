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
use Gabrieljmj\Should\Exception\ClassDoesNotExistException;
use Gabrieljmj\Should\Exception\PropertyDoesNotExistException;
use Gabrieljmj\Should\Exception\MethodDoesNotExistException;
use Gabrieljmj\Should\Exception\ParameterDoesNotExistException;

class ShouldException
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
     * @throws \Gabrieljmj\Should\Exception\ClassDoesNotExistException
     */
    public static function classDoesNotExist($class)
    {
        ClassDoesNotExistException::trigger($class);
    }
    
    /**
     * @param string|object $class
     * @param string        $property
     * @throws \Gabrieljmj\Should\Exception\PropertyDoesNotExistException
     */
    public static function propertyDoesNotExist($class, $property)
    {
        PropertyDoesNotExistException::trigger($class, $property);
    }

    /**
     * @param string|object $class
     * @param string        $method
     * @throws \Gabrieljmj\Should\Exception\MethodDoesNotExistException
     */
    public statiC function methodDoesNotExist($class, $method)
    {
        MethodDoesNotExistException::trigger($class, $method);
    }

    /**
     * @param string|object $class
     * @param string        $method
     * @param string        $parameter
     * @throws \Gabrieljmj\Should\Exception\ParameterDoesNotExistException
     */
    public static function parameterDoesNotExist($class, $method, $parameter)
    {
        ParameterDoesNotExistException::trigger($class, $method, $parameter);
    }
}