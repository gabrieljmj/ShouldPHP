<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheParameter;

use Gabrieljmj\Should\Assert\AbstractAssert;

abstract class AbstractParameterAssert extends AbstractAssert
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
     * @var string
     */
    protected $parameter;
    
    /**
     * @param string|object $class
     * @param string        $method
     * @param string        $parameter
     */
    public function __construct($class, $method, $parameter)
    {
        $this->class = $class;
        $this->method = $method;
        $this->parameter = $parameter;
    }

    /**
     * Returns the tested element
     *
     * @return string
     */
    public function getTestedElement()
    {
        $class = $this->classToStr($this->class);
        return $class . '::' . $this->method . '([$' . $this->parameter . '])';
    }
}