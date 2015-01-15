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

abstract class AbstractShould implements ShouldInterface
{
    public $have;

    public $be;

    public function getAssertList()
    {
        return array_merge($this->have->getAssertList(), $this->be->getAssertList());
    }

    public function __set($property, $value)
    {
        if ($property === 'have' || $property === 'be') {
            throw new InvalidArgumentException(sprintf('You can not set the properties Gabrieljmj\Should\%s::$have and Gabrieljmj\Should\%s::$be', get_class($this), get_class($this)));
        }

        $this->{$property} = $value;
    }
}