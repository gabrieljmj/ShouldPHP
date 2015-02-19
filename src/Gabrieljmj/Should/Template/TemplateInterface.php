<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Template;

use Gabrieljmj\Should\Template\RenderizableInterface;

interface TemplateInterface extends RenderizableInterface
{
    /**
     * Enable colors for tests
     * 
     * @param boolean $enable
     */
    public function colors($enable = true);
}