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

use Gabrieljmj\Should\Assert\TheMethod\AbstractMethodAssert;

class ArgumentsEqual extends AbstractMethodAssert
{
    private $expectedArgs;

    private $returned;

    public function __construct($class, $method, array $expectedArgs)
    {
        parent::__construct($class, $method);
        $this->expectedArgs = $expectedArgs;
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

        $this->returned = $params;

        return $this->expectedArgs === $params;
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if the arguments of the method are equal expected.';
    }

    /**
     * Returns teh fail description
     * Null case in case of success
     *
     * @return string|null
     */
    public function getFailMessage()
    {
        $class = $this->classToStr($this->class);
        return $this->execute() ? null : 'The arguments of the method ' . $class . '::' . $this->method . ' are incorrect. Expcted: ' . print_r($this->expectedArgs, true) . ' - Returned: ' . print_r($this->returned, true);
    }
}