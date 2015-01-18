<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Condition;

use Gabrieljmj\Should\Condition\ConditionInterface;
use Gabrieljmj\Should\Assert\AssertInterface;

abstract class AbstractCondition implements ConditionInterface
{
    protected $assertList = [];
    
    public function getAssertList()
    {
       return $this->assertList; 
    }
    
    public function addAssert(AssertInterface $assert)
    {
        $this->assertList[] = $assert;
    }
}