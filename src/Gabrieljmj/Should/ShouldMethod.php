<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Gabrieljmj\Should;

use Gabrieljmj\Should\Condition\TheMethod\Be;
use Gabrieljmj\Should\Condition\TheMethod\Have;

class ShouldMethod extends AbstractShould
{
    public function __construct($class, $method)
    {
        $class = is_object($class) ? get_class($class) : $class;
        $this->have = new Have($class, $method);
        $this->be = new Be($class, $method);
    }
}