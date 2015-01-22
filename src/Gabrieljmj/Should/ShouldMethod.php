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
use Gabrieljmj\Should\Condition\TheMethod\Be;
use Gabrieljmj\Should\Condition\TheMethod\Have;

class ShouldMethod implements ShouldInterface
{
    public $have;

    public $be;

    public function __construct($class, $method)
    {
        $this->have = new Have($class, $method);
        $this->be = new Be($class, $method);
    }

    public function getAssertList()
    {
        return array_merge($this->have->getAssertList(), $this->be->getAssertList());
    }
}