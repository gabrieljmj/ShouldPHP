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

class AmbientClassDoesNotImplementAmbientInterfaceException extends \InvalidArgumentException
{
    public static function trigger($ambient)
    {
        $class = is_object($ambient) ? get_class($ambient) : $ambient;
        throw new InvalidTypeHintingException('Ambient class does not implement AmbientInterface: ' . $class, ExceptionCodes::AMBIENT_CLASS_DOES_NOT_IMPLEMENT_AMBIENTINTERFACE);
    }
}