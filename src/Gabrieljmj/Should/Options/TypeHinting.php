<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Options;

class TypeHinting
{
    const ARR = 1;
    const CALL = 2;
    const VARIADIC = 3;
    const INSTANCE_OF = 4;

    public static $class;

    public static function anInstanceOf($class)
    {
        self::$class = $class;

        return self::INSTANCE_OF;
    }
}