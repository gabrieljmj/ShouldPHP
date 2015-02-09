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

trait FileParserTrait
{
    protected function getExt($file)
    {
        $e = explode('.', $file);
        return end($e);
    }
}