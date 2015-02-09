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

class MethodDoesNotExistException extends \InvalidArgumentException
{
    public static function trigger($class, $method)
    {
        $class = is_object($class) ? get_class($class) : $class;
        throw new MethodDoesNotExistException('The method ' . $class . '::' . $method . ' does not exist', ExceptionCodes::METHOD_DOES_NOT_EXIST);
    }
}