<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */

namespace Gabrieljmj\Should\Assert\Traits;

use Gabrieljmj\Should\Options\Visibility;
use Gabrieljmj\Should\Exception\ShouldException;

trait VisibilityAssertTrait
{
    protected function check($ref, $visibility)
    {
        if (!$ref instanceof \ReflectionMethod && !$ref instanceof \ReflectionProperty) {
            throw new \InvalidArgumentException('The reflection param passed should be an instance of ReflectionMethod or RelfectionProperty');
        }

        switch($visibility){
            case Visibility::AS_PUBLIC:
                return $ref->isPublic();
            case Visibility::AS_PROTECTED:
                return $ref->isProtected();
            case Visibility::AS_PRIVATE:
                return $ref->isPrivate();
            default:
                ShouldException::invalidVisibilityType($visibility);
        }
    }
}