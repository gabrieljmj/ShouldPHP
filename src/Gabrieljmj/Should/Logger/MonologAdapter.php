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

use Gabrieljmj\Should\Logger\LoggerAdapterInterface;
use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

class MonologAdapter extends MonologLogger implements LoggerAdapterInterface
{
    public function setFile($file, $type = null)
    {
        $this->pushHandler(new StreamHandler($file), $type);
    }
}