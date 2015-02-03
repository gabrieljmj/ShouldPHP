<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheMethod\Be;

use Gabrieljmj\Should\Assert\TheMethod\AbstractMethodAssert;
use Gabrieljmj\Should\Options\Visibility;
use Gabrieljmj\Should\Exception\InvalidVisibilityTypeException;

class VisibleAs extends AbstractMethodAssert
{
    use \Gabrieljmj\Should\Assert\Traits\VisibilityAssertTrait;

    /**
     * Visibility (public, private, protected)
     * Use the constants of \Gabrieljmj\Should\Options\Visibility
     *
     * @var integer
     */
    private $visibility;

    /**
     * @param string|object $class
     * @param string        $method
     * @param integer       $visibility \Gabrieljmj\Should\Options\Visibility consts
     */
    public function __construct($class, $method, $visibility)
    {
        parent::__construct($class, $method);
        $this->visibility = $visibility;
    }

    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute()
    {
        $ref = new \ReflectionMethod($this->class, $this->method);

        return $this->check($ref, $this->visibility);
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if the visibility of a method is the same as the determined.';
    }

    /**
     * Creates the fail message
     *
     * @return string
     */
    protected function createFailMessage()
    {
        $class = $this->classToStr($this->class);
        return 'The arguments of the method ' . $class . '::' . $this->method . ' are incorrect';
    }
}