<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Runner;

use Gabrieljmj\Should\Runner\Rule\RuleInterface;

interface RunnerInterface
{
    /**
     * Runs the tests
     *
     * @param mixed $param
     */
    public function run($param);

    /**
     * Returns the tests report (after run)
     *
     * @return \Gabrieljmj\Should\Report\Report
     */
    public function getReport();

    /**
     * Verifies if runner can handle
     *
     * @param mixed $param
     * @return boolean
     */
    public function canHandle($param);

    /**
     * Pushes a rule
     *
     * @param \Gabrieljmj\Should\Runer\Rule\RuleInterface $rule
     */
    public function pushRule(RuleInterface $rule);
}