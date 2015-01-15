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
    public $be;

    public function getAssertList()
    {
        return $this->be->getAssertList();
    }

    public function __construct($class, $property)
    {
        $this->be = new Be($class, $property);
    }
}