<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheClass;

use Gabrieljmj\Should\Assert\AbstractAssert;

abstract class AbstractClassAssert extends AbstractAssert
{
    /**
     * @var string
     */
    protected $class;
    
    /**
     * @param string|object $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * Returns the tested element
     *
     * @return string
     */
    public function getTestedElement()
    {
        $class = is_object($this->class) ? get_class($this->class) : $this->class;
        return $class;
    }
}