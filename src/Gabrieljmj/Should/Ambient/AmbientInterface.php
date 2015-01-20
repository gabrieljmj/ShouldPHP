<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Ambient;

interface AmbientInterface
{
    /**
     * Returns the ambient name
     *
     * @return string
     */
    public function getName();
    
    /**
     * Runs the tests and create the report
     */
    public function run();
    
    /**
     * Returns the ambient tests report
     *
     * @param \Gabrieljmj\Should\Report\Report
     */
    public function getReport();
}