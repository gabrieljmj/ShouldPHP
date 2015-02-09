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
use Gabrieljmj\Should\Exception\ShouldException;

abstract class AbstractMethodAssert extends AbstractAssert
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
     * @param string|object $class
     * @param string        $method
     */
    public function __construct($class, $method)
    {
        $this->validateData($class, $method);

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
        $class = $this->classToStr($this->class);
        return $class . '::' . $this->method;
    }

    /**
     * @param string|object $class
     * @param string        $method
     */
    private function validateData($class, $method)
    {
        $this->validateClass($class);

        if (!method_exists($class, $method)) {
            ShouldException::methodDoesNotExist($class, $method);
        }
    }
}