<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Gabrieljmj\Should;

use Gabrieljmj\Should\AbstractType;
use Gabrieljmj\Should\ShouldMethod;
use \InvalidArgumentException;
use \Exception;

class TheMethod extends AbstractType
{
    /**
     * @var \Gabrieljmj\Should\ShouldClass
     */
    public $should;
    
    /**
     * @param \Gabrieljmj\Should\ShouldMethod $should
     */
    public function __construct(ShouldMethod $should)
    {
        $this->setShould($should);
    }
}