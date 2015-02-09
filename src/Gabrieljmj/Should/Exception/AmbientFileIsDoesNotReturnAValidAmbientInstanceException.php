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

class AmbientFileIsDoesNotReturnAValidAmbientInstanceException extends \RuntimeException
{
    public function trigger($ambient)
    {
        $class = is_object($ambient) ? get_class($ambient) : $ambient;
        throw new DirectoryDoesNotExists('Ambient is not instance of AmbientInterface: ' . $class, ExceptionCodes::AMBIENT_FILE_DOES_NOT_RETURN_A_VALID_AMBIENT_INSTANCE);
    }
}