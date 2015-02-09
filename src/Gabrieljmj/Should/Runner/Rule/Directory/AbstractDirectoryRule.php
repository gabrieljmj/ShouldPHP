<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Runner\Rule\Directory;

use Gabrieljmj\Should\Runner\Rule\Directory\DirectoryRuleInterface;

abstract class AbstractDirectoryRule implements DirectoryRuleInterface
{
    use \Gabrieljmj\Should\Tool\DirectoryValidatorTrait;

    /**
     * Executes the rule, filtering the directory files
     *
     * @param string $param
     * @return array
     */
    public function execute($param)
    {
        $dir = $this->validateDir($param);
        $path = realpath($dir);

        $entries = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
        $files = [];

        foreach ($entries as $key => $name) {
            $files[$key] = $name;
            if (end(explode('\\', $name)) === '.' || end(explode('\\', $name)) === '..' || is_dir($name) || !$this->appliesTheRule($name)) {
                unset($files[$key]);
            }
        }

        return $files;
    }

    /**
     * Applies the rule
     *
     * @param string $file
     * @return boolean
     */
    abstract protected function appliesTheRule($file);
}