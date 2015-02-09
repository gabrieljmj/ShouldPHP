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
use Gabrieljmj\Should\Runner\Rule\Directory\DirectoryRuleInterface;
use Gabrieljmj\Should\Runner\Rule\RuleInterface;
use Gabrieljmj\Should\Ambient\AmbientInterface;

class DirectoryRunner extends AbstractRunner
{
    use \Gabrieljmj\Should\Tool\DirectoryValidatorTrait;
    use \Gabrieljmj\Should\Tool\ClassFileInfoTrait;

    /**
     * Runs the tests
     *
     * @param mixed $param
     */
    public function run($param)
    {
        $dir = $this->validateDir($param);
        $verifiedFiles = [];
        $files = [];

        if (count($this->rules) > 0) {
            foreach ($this->rules as $rule) {
                $verifiedFiles[] = $rule->execute($dir);
            }

            if (count($verifiedFiles) > 1) {
                $files = call_user_func_array('array_intersect', $verifiedFiles);
            } else {
                foreach ($verifiedFiles as $validFiles) {
                    $files = array_merge($validFiles, $files);
                }
            }
        } else {
            $path = realpath($dir);
            $entries = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);

            foreach ($entries as $key => $name) {
                $files[$key] = $name;
                $e = explode('\\', $name);
                if (end($e) === '.' || end($e) === '..' || is_dir($name)) {
                    unset($files[$key]);
                }
            }
        }

        $ambients = ['files' => [], 'classes' => []];
        $classesReports = [];

        foreach ($files as $file) {
            $require = require_once $file;

            if (!$require instanceof AmbientInterface) {
                $ref = new \ReflectionClass($this->getNamespace($file) . '\\' . $this->getClass($file));
                $ambients['classes'][] = $this->getNamespace($file) . '\\' . $this->getClass($file);
            } else {
                $ambients['files'][] = $require;
            }
        }

        foreach ($ambients['files'] as $ambient) {
            $this->runTest($ambient);
        }

        $classRunner = new AmbientClassRunner();

        foreach ($ambients['classes'] as $ambient) {
            $classRunner->run($ambient);
            $classesReports[] = $classRunner->getReport();
        }

        foreach ($classesReports as $report) {
            $this->combineReport($report);
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
        return is_dir($param);
    }

    /**
     * @param
     */
    protected function acceptRule(RuleInterface $rule)
    {
        return $rule instanceof DirectoryRuleInterface;
    }
}