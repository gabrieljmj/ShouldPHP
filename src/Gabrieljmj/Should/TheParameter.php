<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should;

use Gabrieljmj\Should\AbstractType;
use Gabrieljmj\Should\ShouldParameter;
use \InvalidArgumentException;
use \Exception;

class TheParameter extends AbstractType
{
    /**
     * @var \Gabrieljmj\Should\ShouldParameter
     */
    public $should;
    
    /**
     * @param \Gabrieljmj\Should\ShouldParameter $should
     */
    public function __construct(ShouldParameter $should)
    {
        $this->setShould($should);
    }
}