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
use \InvalidArgumentException;
use \ReflectionMethod;

class ArgumentsEqual extends AbstractAssert
{
    private $class;

    private $method;

    private $expectedArgs;

    public function __construct($class, $method, array $expectedArgs)
    {
        $this->class = is_object($class) ? get_class($class) : $class;
        $this->method = $method;
        $this->expectedArgs = $expectedArgs;
    }

    public function execute()
    {
        $ref = new ReflectionMethod($this->class, $this->method);
        $params = $ref->getParameters();

        $params = array_map(function ($param)
        {
            return $param->getName();
        }, $params);

        return $this->expectedArgs === $params;
    }

    public function getDescription()
    {
        return 'Tests if the parameters ';
    }

    public function getFailMessage()
    {
        
    }
}