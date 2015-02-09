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

use Gabrieljmj\Should\Runner\RunnerInterface;
use Gabrieljmj\Should\Runner\Rule\RuleInterface;
use Gabrieljmj\Should\Ambient\AmbientInterface;
use Gabrieljmj\Should\Report\Report;

abstract class AbstractRunner implements RunnerInterface
{
    /**
     * @var \Gabrieljmj\Should\Report\Report
     */
    protected $report;

    /**
     * @var array
     */
    protected $rules = [];

    public function __construct()
    {
        $this->report = new Report('test');
    }

    /**
     * @param \Gabrieljmj\Should\AmbientInterface $ambient
     */
    protected function runTest(AmbientInterface $ambient)
    {
        $ambient->run();
        $cReport = $ambient->getReport();

        if ($this->report === null) {
            $this->report = new Report('test');
        }

        $this->combineReport($cReport);
    }

    public function pushRule(RuleInterface $rule)
    {
        if ($this->acceptRule($rule)) {
            if (!in_array($rule, $this->rules)) {
                $this->rules[] = $rule;
            }
        }
    }

    /**
     * Returns the test report
     *
     * @return \Gabrieljmj\Should\Report\Report
     */
    public function getReport()
    {
        return $this->report;
    }

    protected function combineReport(Report $report)
    {
        $assertList = $report->getAssertList();

        foreach ($assertList as $testType => $value) {
            if (isset($assertList[$testType]['fail'])) {
                foreach ($assertList[$testType]['fail'] as $element => $fails) {
                    foreach ($fails as $fail) {
                        $this->report->addAssert($fail);
                    }
                }
            }

            if (isset($assertList[$testType]['success'])) {
                foreach ($assertList[$testType]['success'] as $element => $successes) {
                    foreach ($successes as $success) {
                        $this->report->addAssert($success);
                    }
                }
            }
        }
    }

    abstract protected function acceptRule(RuleInterface $rule);
}