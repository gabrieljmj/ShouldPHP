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

use Gabrieljmj\Should\Exception\ExceptionCodes;

class PropertyDoesNotExistsException extends \InvalidArgumentException
{
    public static function trigger($class, $property)
    {
        $class = is_object($class) ? get_class($class) : $class;
        throw new PropertyDoesNotExistsException('The property ' . $class . '::$' . $property . ' does not exists', ExceptionCodes::PROPERTY_DOES_NOT_EXISTS);
    }
}