<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should;

use Gabrieljmj\Should\Condition\TheProperty\Be;

class ShouldProperty extends AbstractShould
{
    public function __construct($class, $property)
    {
        $class = is_object($class) ? get_class($class) : $class;
        $this->be = new Be($class, $property);
    }
}