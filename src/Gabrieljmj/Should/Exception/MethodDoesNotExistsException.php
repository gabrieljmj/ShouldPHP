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

class MethodDoesNotExistsException extends \InvalidArgumentException
{
    public static function trigger($class, $method)
    {
        $class = is_object($class) ? get_class($class) : $class;
        throw new MethodDoesNotExistsException('The method ' . $class . '::' . $method . ' does not exists', ExceptionCodes::METHOD_DOES_NOT_EXISTS);
    }
}