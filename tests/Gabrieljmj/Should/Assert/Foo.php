<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Test\Gabrieljmj\Should\Assert;

class Foo implements \Serializable
{
    public $public;
    protected $protected;
    private $private;

    public function getBar()
    {
        return 'bar';
    }

    public function serialize()
    {
    }

    public function unserialize($str)
    {
    }
}