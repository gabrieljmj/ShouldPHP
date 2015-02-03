<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert\TheProperty\Be;

use Gabrieljmj\Should\Assert\TheProperty\AbstractPropertyAssert;
use Gabrieljmj\Should\Exception\InvalidVisibilityTypeException;
use Gabrieljmj\Should\Options\Visibility;

class VisibleAs extends AbstractPropertyAssert
{
    use \Gabrieljmj\Should\Assert\Traits\VisibilityAssertTrait;

    private $visibility;

    private $texts = [
        Visibility::AS_PUBLIC => 'public',
        Visibility::AS_PROTECTED => 'protected',
        Visibility::AS_PRIVATE => 'private'
    ];

    public function __construct($class, $property, $visibility)
    {
        parent::__construct($class, $property);
        $this->visibility = $visibility;
    }

    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute()
    {
        $ref = new \ReflectionProperty($this->class, $this->property);

        return $this->check($ref, $this->visibility);
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Tests if the visibility of a property is the same as the determined.';
    }

    /**
     * Creates the fail message
     *
     * @return string
     */
    protected function createFailMessage()
    {
        $class = is_object($this->class) ? get_class($this->class) : $this->class;
        return 'The property ' . $this->property . ' of the class ' . $class . ' is not ' . $this->texts[$this->visibility];
    }
}