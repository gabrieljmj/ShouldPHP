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

use Gabrieljmj\Should\ShouldInterface;
use Gabrieljmj\Should\Condition\TheParameter\Have;

class ShouldParameter implements ShouldInterface
{
    public $have;

    public function __construct($class, $method, $parameter)
    {
        $this->have = new Have($class, $method, $parameter);
    }

    public function getAssertList()
    {
        return $this->have->getAssertList();
    }
}