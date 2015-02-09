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
use Gabrieljmj\Should\Runner\Rule\AmbientClass\AbientClassRunnerInterface;
use Gabrieljmj\Should\Runner\Rule\RuleInterface;
use Gabrieljmj\Should\Ambient\AmbientInterface;

class AmbientClassRunner extends AbstractRunner
{
    /**
     * Runs the tests
     *
     * @param mixed $param
     */
    public function run($param)
    {
        $class = str_replace('/', '\\', $param);
        $ambient = $this->validateClass($class);
        $ref = new \ReflectionClass($ambient);
        $methods = $ref->getMethods();

        foreach ($methods as $method) {
            if ($method->isPublic()) {
                if (strtolower(substr($method->name, 0, 4)) === 'test') {
                    call_user_func_array([$ambient, $method->name], []);
                }
            }
        }

        $this->runTest($ambient);
    }

    /**
     * Verifies if runner can handle something
     *
     * @param mixed $param
     * @return mixed
     */
    public function canHandle($param)
    {
        if (!class_exists($param)) {
            return class_exists(str_replace('/', '\\', $param));
        }

        return true;
    }

    /**
     * Validates the ambient class
     *
     * @param string $class
     * @return \Gabrieljmj\Should\Ambient\AmbientInterface
     */
    private function validateClass($class)
    {
        if (!class_exists($class)) {
            if (!class_exists(str_replace('/', '\\', $class))) {
                AmbientClassDoesNotExistException::trigger($class);
            }
        } elseif (!$class instanceof AmbientInterface) {
            //RunnerException::ambientClassDoesNotImplementAmbientInterface($class);
        }

        $ref = new \ReflectionClass($class);
        return $ref->newInstance();
    }

    /**
     * Verifies if accepts certain rule
     *
     * @param \Gabrieljmj\Should\Runner\Rule\RuleInterface $rule
     * @return boolean
     */
    protected function acceptRule(RuleInterface $rule)
    {
        return $rule instanceof AmbientClassRuleInterface;
    }
}