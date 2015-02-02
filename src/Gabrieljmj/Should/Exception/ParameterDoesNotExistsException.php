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

class ParameterDoesNotExistsException extends \InvalidArgumentException
{
    public static function trigger($class, $method, $parameter)
    {
        $class = is_object($class) ? get_class($class) : $class;
        throw new ParameterDoesNotExistsException('The parameter ' . $parameter . ' does not exists on method ' . $class . '::' . $method, ExceptionCodes::PARAMETER_DOES_NOT_EXISTS);
    }
}