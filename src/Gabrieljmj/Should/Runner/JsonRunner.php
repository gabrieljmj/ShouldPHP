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

use Gabrieljmj\Should\Runner\AbstractRunner;
use Gabrieljmj\Should\Runner\Rule\RuleInterface;
use Gabrieljmj\Should\Report\Report;
use Gabrieljmj\Should\Runner\Rule\Json\JsonRuleInterface;

class JsonRunner extends AbstractRunner
{
    private $runners;

    public function __construct(array $runners)
    {
        parent::__construct();

        foreach ($runners as $runner) {
            if (!$runner instanceof RunnerInterface) {
                throw new \InvalidArgumentException('A runner passed is not instance of RunnerInterface');
            }
        }

        $this->runners = $runners;
    }

    /**
     * Runs the tests
     *
     * @param mixed $param
     */
    public function run($param)
    {
        $content = file_get_contents($param);
        $json = json_decode($content);
        $reports = [];
        $ruleNamespace = '\Gabrieljmj\Should\Runner\Rule';

        if (isset($json->ambients)) {
            $ambients = $json->ambients;
            if (isset($json->rules)) {
                $rules = $json->rules;

                foreach ($rules as $category => $categoryRules) {
                    foreach ((array) $categoryRules as $key => $value) {
                        $class = is_string($key) && is_array($value) 
                            ? $ruleNamespace . '\\' . ucfirst($category) . '\\' . ucfirst($key) 
                            : $ruleNamespace . '\\' . ucfirst($category) . '\\' . ucfirst($value);

                        $ref = new \ReflectionClass($class);
                        $ruleI = is_string($key) && is_array($value) ? $ref->newInstanceArgs($value) : $ref->newInstance();

                        foreach ($this->runners as $key => $runner) {
                            $runner->pushRule($ruleI);
                            $this->runners[$key] = $runner;
                        }
                    }
                }
            }

            $this->createReportFromAmbients($ambients);
        }
    }

    /**
     * Verifies if runner can handle something
     *
     * @param mixed $param
     * @return mixed
     */
    public function canHandle($param)
    {
        return file_exists($param) && substr($param, -5) === '.json';
    }

    protected function acceptRule(RuleInterface $rule)
    {
        return $rule instanceof JsonRuleInterface;
    }

    /**
     * Creates the report from all executed ambients
     *
     * @param array $ambients
     */
    private function createReportFromAmbients(array $ambients){
        $reports = [];

        foreach ($ambients as $ambient) {
            foreach ($this->runners as $runner) {
                if ($runner->canHandle($ambient)) {
                    $runner->run($ambient);
                    $reports[] = $runner->getReport();
                }
            }
        }

        foreach ($reports as $report) {
            $this->combineReport($report);
        }
    }
}