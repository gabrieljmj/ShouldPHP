<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Gabrieljmj\Should;

use Gabrieljmj\Should\ShouldProperty;
use Gabrieljmj\Should\AbstractType;
use \InvalidArgumentException;
use \Exception;

class TheProperty extends AbstractType
{
    /**
     * @var \Gabrieljmj\Should\ShouldProperty
     */
    public $should;
    
    /**
     * @param \Gabrieljmj\Should\ShouldProperty $should
     */
    public function __construct(ShouldProperty $should)
    {
        $this->setShould($should);
    }
}