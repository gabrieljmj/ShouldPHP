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

class ConsoleException extends \RuntimeException
{
    public static function ambientFileDoesNotExist($file)
    {
        throw new ConsoleException('The file of an ambient was not found: ' . $file, ExceptionCodes::AMBIENT_FILE_DOES_NOT_EXIST);
    }

    public static function ambientFilesDoesNotReturnAnInstanceOfAValidAmbient($file)
    {
        throw new ConsoleException('The file of an ambient does not return an instance of a valid ambient: ' . $file, ExceptionCodes::AMBIENT_FILE_DOES_NOT_RETURN_A_VALID_AMBIENT_INSTANCE);
    }

    public static function directoryIsNotReadable($dir)
    {
        throw new ConsoleException('Directory not readable: ' . $dir, ExceptionCodes::DIRECTORY_NOT_READABLE);
    }

    public static function ambientIsNotInstanceOfAmbientInterface($ambient)
    {
        $ambient = is_object($ambient) ? get_class($ambient) : print_r($ambient, true);
        throw new ConsoleException('The ambient class indicated is not a vlid ambient: ' . $ambient, ExceptionCodes::AMBIENT_IS_NOT_VALID);
    }
}