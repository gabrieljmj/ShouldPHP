<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheMethod\Have;

use Gabrieljmj\Should\Assert\AbstractAssert;
use ReflectionMethod;

class ArgumentsEqual extends AbstractAssert
{
    private $class;

    private $method;

    private $expectedArgs;

    private $returned;

    public function __construct($class, $method, array $expectedArgs)
    {
        $this->class = $class;
        $this->method = $method;
        $this->expectedArgs = $expectedArgs;
    }

    /**
     * Returns the tested element
     *
     * @return string
     */
    public function getTestedElement()
    {
        return $this->class . '::' . $this->method;
    }

    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute()
    {
        $ref = new \ReflectionMethod($this->class, $this->method);
        $params = $ref->getParameters();

        $params = array_map(function ($param)
        {
            return $param->getName();
        }, $params);

        $this->return = $params;

        return $this->expectedArgs === $params;
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if the parameters ';
    }

    /**
     * Returns teh fail description
     * Null case in case of success
     *
     * @return string|null
     */
    public function getFailMessage()
    {
        return $this->execute() ? null : 'The arguments of the method ' . $class . '::' . $this->method . ' are incorrect. Expcted: ' . print_r($this->excpectedArgs, true) . ' - Returned: ' . print_r($this->returned, true);
    }
}