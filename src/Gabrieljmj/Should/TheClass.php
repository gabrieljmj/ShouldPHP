<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Gabrieljmj\Should;

use Gabrieljmj\Should\ShouldClass;
use Gabrieljmj\Should\AbstractType;
use \InvalidArgumentException;
use \Exception;

class TheClass extends AbstractType
{
    /**
     * @var \Gabrieljmj\Should\ShouldClass
     */
    public $should;
    
    /**
     * @param \Gabrieljmj\Should\ShouldClass $should
     */
    public function __construct(ShouldClass $should)
    {
        $this->setShould($should);
    }
}