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

class PropertyDoesNotExistException extends \InvalidArgumentException
{
    public static function trigger($class, $property)
    {
        $class = is_object($class) ? get_class($class) : $class;
        throw new PropertyDoesNotExistException('The property ' . $class . '::$' . $property . ' does not exist', ExceptionCodes::PROPERTY_DOES_NOT_EXIST);
    }
}