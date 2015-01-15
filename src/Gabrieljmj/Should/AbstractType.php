<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Gabrieljmj\Should;

use Gabrieljmj\Should\ShouldInterface;

abstract class AbstractType
{
    /**
     * @param string $property
     * @param mixed  $value
     */
    public function __set($property, $value)
    {
        if ($property === 'should') {
            throw new Exception(sprintf('You can not set the property Gabrieljmj\Should\%s::$should', get_class($this)));
        }
        
        $this->{$property} = $value;
    }

    /**
     * @param \Gabrieljmj\Should\ShouldInterface $should
     */
    protected function setShould(ShouldInterface $should)
    {
        $this->should = $should;
    }
}