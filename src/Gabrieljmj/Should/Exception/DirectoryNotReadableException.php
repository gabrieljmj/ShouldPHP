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

class DirectoryNotReadableException extends \RuntimeException
{
    public function trigger($dir)
    {
        throw new DirectoryDoesNotExists('Directory not readable: ' . $dir, ExceptionCodes::DIRECTORY_NOT_READABLE);
    }
}