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
            return $this->classToString($this->class) === $this->classToString($this->arg2);
        }
    }

    /**
     * Returns teh fail description
     * Null case in case of success
     *
     * @return string|null
     */
    public function getFailMessage()
    {
        $class = $this->classToString($this->class);
        $arg2 = $this->classToString($this->arg2);
        return $this->execute() ? null : $class . ' is not instance of ' . $arg2;
    }

    private function classToString($class)
    {
        return is_object($class) ? get_class($class) : $class;
    }
}