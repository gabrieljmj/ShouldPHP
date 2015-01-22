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

class AsReturn extends AbstractMethodAssert
{
    private $expectedReturn;

    private $args;

    private $returned;

    public function __construct($class, $method, $expectedReturn, array $args)
    {
        parent::__construct($class, $method);
        $this->expectedReturn = $expectedReturn;
        $this->args = $args;
    }

    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute()
    {
        if (is_object($this->class)) {
            $ref = new \ReflectionMethod($this->class, $this->method);
            $this->returned = $ref->invokeArgs($this->class, $this->args);
        } else {
            $this->returned = call_user_func_array([$this->class, $this->method], $this->args);
        }

        return $this->returned == $this->expectedReturn;
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if the return of a method is equal expected.';
    }

    /**
     * Returns teh fail description
     * Null case in case of success
     *
     * @return string|null
     */
    public function getFailMessage()
    {
        return;
    }
}