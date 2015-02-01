<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Logger;

use Psr\Log\LoggerInterface;

interface LoggerAdapterInterface extends LoggerInterface
{
    /**
     * Sets the file to save logs
     *
     * @param string       $file
     * @param integer|null $type
     */
    public function setFile($file, $type = null);
}