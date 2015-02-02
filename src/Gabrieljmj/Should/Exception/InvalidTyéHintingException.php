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

class InvalidTypeHintingException extends \InvalidArgumentException
{
    public static function trigger($type)
    {
        throw new InvalidTypeHintingException('Invalid type hinting type: ' . $type, ExceptionCodes::INVALID_TYPE_HINTING);
    }
}