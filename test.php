<?php
require_once 'vendor/autoload.php';

use Gabrieljmj\Should\Ambient;

class tee
{
    public function r($a)
    {
    }
}

$a = new Ambient('test');
$a->theMethod('r', '\tee')->should->have->argumentsEqual(['a']);
echo get_class($a);
return $a;