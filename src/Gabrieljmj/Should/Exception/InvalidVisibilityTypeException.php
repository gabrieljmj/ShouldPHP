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

class InvalidVisibilityTypeException extends \InvalidArgumentException
{
    public static function trigger($type)
    {
        throw new InvalidVisibilityTypeException('Invalid visibility type: ' . $type, ExceptionCodes::INVALID_VISIBILITY_TYPE);
    }
}