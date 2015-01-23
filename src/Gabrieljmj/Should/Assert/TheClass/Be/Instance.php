<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheClass\Be;

use Gabrieljmj\Should\Assert\TheClass\AbstractClassAssert;

class Instance extends AbstractClassAssert
{
    private $arg2;
    
    public function __construct($class, $arg2)
    {
        parent::__construct($class);
        $this->arg2 = $arg2;
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if the object is of the a class or has this class as one of its parents.';
    }

    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute()
    {
        $ref = new \ReflectionClass($this->class);
        $arg2Ref = new \ReflectionClass($this->arg2);

        if ($arg2Ref->isInterface()) {
            return $ref->implementsInterface($this->arg2);
        } elseif ($ref->isSubclassOf($this->arg2)) {
            return true;
        } else {
            return $this->classToStr($this->class) === $this->classToStr($this->arg2);
        }
    }

    /**
     * Creates the fail message
     *
     * @return string
     */
    protected function createFailMessage()
    {
        $class = $this->classToStr($this->class);
        $arg2 = $this->classToStr($this->arg2);
        return $class . ' is not instance of ' . $arg2;
    }
}