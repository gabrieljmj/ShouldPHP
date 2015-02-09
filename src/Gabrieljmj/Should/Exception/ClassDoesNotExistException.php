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

class ClassDoesNotExistException extends \InvalidArgumentException
{
    public static function trigger($class)
    {
        $class = is_object($class) ? get_class($class) : $class;
        throw new ClassDoesNotExistException('The class ' . $class . ' does not exist', ExceptionCodes::CLASS_DOES_NOT_EXIST);
    }
}