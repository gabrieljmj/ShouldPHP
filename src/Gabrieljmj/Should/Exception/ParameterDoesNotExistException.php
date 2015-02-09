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

class ParameterDoesNotExistException extends \InvalidArgumentException
{
    public static function trigger($class, $method, $parameter)
    {
        $class = is_object($class) ? get_class($class) : $class;
        throw new ParameterDoesNotExistException('The parameter ' . $parameter . ' does not exist on method ' . $class . '::' . $method, ExceptionCodes::METHOD_PARAMETER_DOES_NOT_EXIST);
    }
}