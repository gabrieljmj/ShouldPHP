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
    private $paramStr = [
        TypeHinting::ARR => 'array',
        TypeHinting::CALL => 'callable',
        TypeHinting::ANYTHING => 'anything',
        TypeHinting::INSTANCE_OF => 'instance'
    ];

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
                    case TypeHinting::VARIADIC:
                        return $param->isVariadic();
                    case TypeHinting::INSTANCE_OF:
                        $class = $param->getClass();
                        $className = $class === null ? null : $class->getName();
                        return TypeHinting::$class === $className;
                    default:
                        throw new \Exception('The type of parameter specified is not valid: ' . $this->type);
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
        $class = is_object($this->class) ? get_class($this->class) : $this->class;

        $error = 'only ';
        if ($this->type === TypeHinting::INSTANCE_OF) {
            $error .= 'instances of ' . TypeHinting::$class;
        } else {
            if ($this->type == TypeHinting::VARIADIC) {
                $error = 'variadic';
            } else {
                $error .= $this->paramStr[$this->type];
            }
        }

        return 'The parameter ' . $this->parameter . ' of method ' . $class . '::' . $this->method . ' should accept ' . $error . ', but does not';
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