<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheMethod;

use Gabrieljmj\Should\Assert\AbstractAssert;

abstract class AbstractMethodAssert extends AbstractAssert
{
    /**
     * @var string
     */
    protected $class;
    
    /**
     * @var string
     */
    protected $method;
    
    /**
     * @param string|object $class
     * @param string        $method
     */
    public function __construct($class, $method)
    {
        $this->class = $class;
        $this->method = $method;
    }

    /**
     * Returns the tested element
     *
     * @return string
     */
    public function getTestedElement()
    {
        $class = is_object($this->class) ? get_class($this->class) : $this->class;
        return $class . '::' . $this->method;
    }
}