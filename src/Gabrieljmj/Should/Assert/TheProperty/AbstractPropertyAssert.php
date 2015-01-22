<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheProperty;

use Gabrieljmj\Should\Assert\AbstractAssert;

abstract class AbstractPropertyAssert extends AbstractAssert
{
    protected $class;

    protected $property;

    /**
     * @param string|object $class
     * @param string        $property
     */
    public function __construct($class, $property)
    {
        $this->class = $class;
        $this->property = $property;
    }

    /**
     * Returns the tested element
     *
     * @return string
     */
    public function getTestedElement()
    {
        $class = $this->classToStr($this->class);
        return $class . '::$' . $this->property;
    }
}