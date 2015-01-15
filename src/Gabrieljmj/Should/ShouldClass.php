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

use Gabrieljmj\Should\Condition\TheClass\Be;
use Gabrieljmj\Should\Condition\TheClass\Have;

class ShouldClass extends AbstractShould
{
    public function __construct($class)
    {
        $this->have = new Have($class);
        $this->be = new Be($class);
    }
}