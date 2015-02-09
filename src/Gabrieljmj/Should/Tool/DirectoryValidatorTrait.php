<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Tool;

use Gabrieljmj\Should\Exception\DirectoryDoesNotExistException;
use Gabrieljmj\Should\Exception\DirectoryNotReadableException;

trait DirectoryValidatorTrait
{
    /**
     * Validates a directory for read
     *
     * @param string $dir
     * @return string
     */
    protected function validateDir($dir)
    {
        if (!is_dir($dir)) {
            DirectoryDoesNotExistException::trigger($dir);
        } elseif (!is_readable($dir)) {
            DirectoryNotReadableException::trigger($dir);
        }

        return $dir;
    }
}