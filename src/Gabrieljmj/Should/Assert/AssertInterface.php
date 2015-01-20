<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Assert;

interface AssertInterface
{
    /**
     * Returns the tested element
     *
     * @return string
     */
    public function getTestedElement();

    /**
     * Returns a custom message in case of fail
     *
     * @return string
     */
    public function getMessage();

    /**
     * Returns teh fail description
     * Null case in case of success
     *
     * @return string|null
     */
    public function getFailMessage();
    
    /**
     * Returns the assert description
     *
     * @return string
     */
    public function getDescription();
    
    /**
     * Executes the assert
     *
     * @return boolean
     */
    public function execute();
}