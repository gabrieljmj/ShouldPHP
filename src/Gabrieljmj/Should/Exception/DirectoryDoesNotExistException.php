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

class DirectoryDoesNotExistException extends \RuntimeException
{
    public function trigger($dir)
    {
        throw new DirectoryDoesNotExists('Directory does not exist: ' . $dir, ExceptionCodes::DIRECTORY_DOES_NOT_EXISTS);
    }
}