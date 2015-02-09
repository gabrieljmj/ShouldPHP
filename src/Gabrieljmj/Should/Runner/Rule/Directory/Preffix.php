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

class Preffix extends AbstractDirectoryRule
{
    /**
     * Files preffix
     *
     * @var string
     */
    private $preffix;

    /**
     * @param string $preffix
     */
    public function __construct($preffix)
    {
        $this->preffix = $preffix;
    }

    /**
     * Applies the rule
     *
     * @param string $file
     * @return boolean
     */
    protected function appliesTheRule($file)
    {
        return substr(end(explode('\\', $file)), 0, strlen($this->preffix)) === $this->preffix;
    }
}