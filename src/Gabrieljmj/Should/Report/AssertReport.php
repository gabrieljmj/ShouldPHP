<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Report;

use Gabrieljmj\Should\Assert\AssertInterface;
use Gabrieljmj\Should\Report\AssertType;

class AssertReport
{
    /**
     * Assert type (class, property, method etc)
     * Use constants from \Gabrieljmj\Should\Report\AssertType
     *
     * @var string
     */
    private $type;

    /**
     * Assert
     *
     * @var \Gabrieljmj\Should\Assert\AssertInterface
     */
    private $assert;

    /**
     * AssertReport constructor
     *
     * @param string                                    $type
     * @param \Gabrieljmj\Should\Assert\AssertInterface $assert
     */
    public function __construct($type, AssertInterface $assert)
    {
        $this->type = $type;
        $this->assert = $assert;
    }

    /**
     * Assert type (class, property, method etc)
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns null if status is true
     *
     * @return string|null
     */
    public function getFailMessage()
    {
        return $this->assert->getFailMessage();
    }

    /**
     * Returns assert name
     *
     * @return string
     */
    public function getName()
    {
        $nameEx = explode('\\', get_class($this->assert));
        return end($nameEx);
    }

    /** 
     * Returns the tested element
     *
     * @return string
     */
    public function getTestedElement()
    {
        return $this->assert->getTestedElement();
    }

    /**
     * Returns the validation status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->assert->execute() ? 'success' : 'fail';
    }

    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->assert->getDescription();
    }
}