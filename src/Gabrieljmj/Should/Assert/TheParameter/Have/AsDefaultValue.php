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

use Gabrieljmj\Should\Assert\AbstractAssert;

class AsDefaultValue extends AbstractAssert
{
    /**
     * @var string
     */
    private $class;
    
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $parameter;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var mixed
     */
    private $value;
    
    public function __construct($class, $method, $parameter, $value)
    {
        $this->class = $class;
        $this->method = $method;
        $this->parameter = $parameter;
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
                return $this->value === $param->getDefaultValue();
            }
        }

        return false;
    }
    
    /**
     * Returns the tested element
     *
     * @return string
     */
    public function getTestedElement()
    {

    }

    /**
     * Returns teh fail description
     * Null case in case of success
     *
     * @return string|null
     */
    public function getFailMessage()
    {
        $class = is_object($this->class) ? get_class($this->class) : $this->class;
        return $this->execute() ? null : 'The default value of the parameter ' . $this->parameter . ' of the ' . $class . '::' . $this->method . ' is not equal to ' . print_r($this->value);
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