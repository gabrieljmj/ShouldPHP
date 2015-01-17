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

use Doctrine\Common\Collections\ArrayCollection;
use \Serializable;

class Collection extends ArrayCollection implements Serializable
{
    public function __construct(array $elements)
    {
        parent::__construct($elements);
    }
    
    public function serialize()
    {
        return serialize($this->toArray());
    }
    
    public function unserialize($param)
    {
        foreach (unserialize($param) as $key => $param) {
            $this->offsetSet($key, $param);
        }
    }
}