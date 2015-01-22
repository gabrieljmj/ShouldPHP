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
use Gabrieljmj\Should\Options\TypeHinting;

class AcceptOnly extends AbstractParameterAssert
{
    /**
     * @var string|array
     */
    private $type;
    
    public function __construct($class, $method, $parameter, $type)
    {
        parent::__construct($class, $method, $parameter);
        $this->type = $type;
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
                switch ($this->type) {
                    case TypeHinting::ARR:
                        return $param->isArray();
                    case TypeHinting::CALL:
                        return $param->isCallable();
                    case TypeHinting::ANYTHING:
                        return $param->isVariadic();
                    case TypeHinting::INSTANCE_OF:
                        $class = $param->getClass();
                        $className = $class ==== null ? null : $class->getName();
                        return TypeHinting::$class === $className;
                    default:
                        throw new \Exception('The type of parameter specified is not valid: ' . $this->type);
                }
            }
        }

        return false;
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
        return 'Tests if certain parameter accept determined value type.';
    }
}