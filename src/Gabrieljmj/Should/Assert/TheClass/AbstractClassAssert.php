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
     * @var string|object
     */
    protected $class;
    
    /**
     * @param string|object $class
     */
    public function __construct($class)
    {
        $this->validateClass($class);

        $this->class = $class;
    }

    /**
     * Returns the tested element
     *
     * @return string
     */
    public function getTestedElement()
    {
        $class = $this->classToStr($this->class);
        return $class;
    }
}