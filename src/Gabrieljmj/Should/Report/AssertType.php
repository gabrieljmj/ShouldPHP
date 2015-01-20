<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Report;

class AssertType
{
    /**
     * Asserts with namespace TheClass
     *
     * @example \Gabrieljmj\Should\Assert\TheClass\Be\Equal
     */
    const CLASS_T = 'class';

    /**
     * Asserts with namespace TheProperty
     *
     * @example \Gabrieljmj\Should\Assert\TheProperty\Be\Equal
     */
    const PROPERTY_T = 'property';

    /**
     * Asserts with namespace TheMethod
     *
     * @example \Gabrieljmj\Should\Assert\TheMethod\Have\ArgumentsEqual
     */
    const METHOD_T = 'method';

    /**
     * Asserts with namespace TheParameter
     *
     * @example \Gabrieljmj\Should\Assert\TheParameter\Have\AsDefaultValue
     */
    const PARAMETER_T = 'parameter';
}