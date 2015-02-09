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
use Gabrieljmj\Should\Exception\ShouldException;

abstract class AbstractParameterAssert extends AbstractAssert
{
    /**
     * @var string|object
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
        $this->validateData($class, $method, $parameter);
        
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

    /**
     * @param string|object $class
     * @param string        $method
     * @param string        $parameter
     */
    private function validateData($class, $method, $parameter)
    {
        $this->validateClass($class);

        if (!method_exists($class, $method)) {
            ShouldException::methodDoesNotExist($class, $method);
        }

        $ref = new \ReflectionMethod($class, $method);
        $paramsNames = array_map(function ($param) {
            return $param->name;
        }, $ref->getParameters());

        if (!in_array($parameter, $paramsNames)) {
            ShouldException::parameterDoesNotExist($class, $method, $parameter);
        }
    }
}