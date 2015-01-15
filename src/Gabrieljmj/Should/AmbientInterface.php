<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should;

interface AmbientInterface
{
    /**
     * @return string
     */
    public function getName();
    
    /**
     * @throws AssertException
    */
    public function run();
    
    /**
     * @param \Gabrieljmj\Should\Report
     */
    public function getReport();
}