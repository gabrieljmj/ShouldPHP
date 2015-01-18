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
use Gabrieljmj\Should\Condition\TheClass\Be;
use Gabrieljmj\Should\Condition\TheClass\Have;

class ShouldClass implements ShouldInterface
{
    public $have;

    public $be;

    public function __construct($class)
    {
        $this->have = new Have($class);
        $this->be = new Be($class);
    }

    public function getAssertList()
    {
        return array_merge($this->have->getAssertList(), $this->be->getAssertList());
    }
}