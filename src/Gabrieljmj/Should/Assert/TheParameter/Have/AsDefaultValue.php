<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheParameter\Have;

use Gabrieljmj\Should\Assert\TheParameter\AbstractParameterAssert;

class AsDefaultValue extends AbstractParameterAssert
{
    /**
     * @var mixed
     */
    private $value;
    
    public function __construct($class, $method, $parameter, $value)
    {
        parent::__construct($class, $method, $parameter);
        $this->value = $value;
    }

    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute()
    {
        $ref = new \ReflectionClass($this->class);
        $method = $ref->getMethod($this->method);
        $params = $method->getParameters();

        foreach ($params as $param) {
            if ($param->getName() === $this->parameter) {
                if ($param->isDefaultValueAvailable()) {
                    return $this->value === $param->getDefaultValue();
                }
            }
        }

        return false;
    }

    /**
     * Creates the fail message
     *
     * @return string
     */
    protected function createFailMessage()
    {
        $class = $this->classToStr($this->class);
        return 'The default value of the parameter ' . $this->parameter . ' of the ' . $class . '::' . $this->method . ' is not equal to ' . print_r($this->value);
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if certain parameter of a method has the default value equals determined one';
    }
}