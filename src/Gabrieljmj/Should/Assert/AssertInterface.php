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
    public function getTestedElement();

    public function getMessage();

    public function getFailMessage();
    
    public function getDescription();
    
    public function execute();
}