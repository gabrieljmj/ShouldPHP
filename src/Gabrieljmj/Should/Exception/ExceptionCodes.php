<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */

namespace Gabrieljmj\Should\Exception;

class ExceptionCodes
{
    /**
     * Visibility type different of public, protected and private
     * (\Gabrieljmj\Should\Options\Visibility constants)
     */
    const INVALID_VISIBILITY_TYPE = 1;

    /**
     * Type hinting different of all constants of \Gabrieljmj\Should\Options\TypeHinting
     */
    const INVALID_TYPE_HINTING = 2;

    /**
     * Method to test does not exists in class
     */
    const METHOD_DOES_NOT_EXISTS = 4;

    /**
     * Class to test does not exists
     */
    const CLASS_DOES_NOT_EXISTS = 8;

    /**
     * Property to test does not exists
     */
    const  PROPERTY_DOES_NOT_EXISTS = 16;

    /**
     * Method parameter to test does not exists
     */
    const METHOD_PARAMETER_DOES_NOT_EXISTS = 32;
}