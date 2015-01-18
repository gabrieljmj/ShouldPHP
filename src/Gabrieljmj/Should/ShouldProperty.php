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
use Gabrieljmj\Should\Condition\TheProperty\Be;

class ShouldProperty implements ShouldInterface
{
    public $be;

    public function __construct($class, $property)
    {
        $this->be = new Be($class, $property);
    }

    public function getAssertList()
    {
        return $this->be->getAssertList();
    }
}