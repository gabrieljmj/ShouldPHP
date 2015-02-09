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
use Gabrieljmj\Should\Runner\Rule\Directory\AmbientFileRuleInterface;
use Gabrieljmj\Should\Runner\Rule\RuleInterface;
use Gabrieljmj\Should\Exception\AmbientFileIsDoesNotReturnAValidAmbientInstanceException;

class AmbientFileRunner extends AbstractRunner
{
    use \Gabrieljmj\Should\Tool\FileParserTrait;

    /**
     * Runs the tests
     *
     * @param mixed $param
     */
    public function run($param)
    {
        $ambient = $this->validateFile($param);
        $this->runTest($ambient);
    }

    /**
     * Validates the file
     *
     * @param string $file
     * @return \Gabrieljmj\Should\Ambient\AmbientInterface
     */
    private function validateFile($file)
    {
        $ambient = require $file;

        if (!$ambient instanceof AmbientInterface) {
            AmbientFileIsDoesNotReturnAValidAmbientInstanceException::trigger($file);
        }

        return $ambient;
    }

    /**
     * Verifies if runner can handle something
     *
     * @param mixed $param
     * @return mixed
     */
    public function canHandle($param)
    {
        return file_exists($param) && substr($param, -4) === '.php';
    }

    protected function acceptRule(RuleInterface $rule)
    {
        return $rule instanceof AmbientFileRuleInterface;
    }
}