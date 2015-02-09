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

use Gabrieljmj\Should\Runner\Rule\Directory\AbstractDirectoryRule;

class Suffix extends AbstractDirectoryRule
{
    /**
     * Files suffix
     *
     * @var string
     */
    private $suffix;

    /**
     * @param string $suffix
     */
    public function __construct($suffix)
    {
        $this->suffix = $suffix;
    }

    /**
     * Applies the rule
     *
     * @param string $file
     * @return boolean
     */
    protected function appliesTheRule($file)
    {
        $e = explode('\\', $file);
        return substr(end($e), -strlen($this->suffix)) !== $this->suffix;
    }
}