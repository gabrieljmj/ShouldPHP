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
        return 'Tests if the object is of the a class or has this class as one of its parents';
    }

    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute()
    {
        $ref = new \ReflectionClass($this->class);
        $parent = $ref->getParentClass();
        $parentName = $parent->name;

        return $ref->isSubclassOf($this->arg2) || $ref->implemetsInterface($this->arg2) ? true : false;
    }

    /**
     * Returns teh fail description
     * Null case in case of success
     *
     * @return string|null
     */
    public function getFailMessage()
    {
        
    }
}