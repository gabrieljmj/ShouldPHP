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
     * Method to test does not exist in class
     */
    const METHOD_DOES_NOT_EXIST = 3;

    /**
     * Class to test does not exist
     */
    const CLASS_DOES_NOT_EXIST = 4;

    /**
     * Property to test does not exist
     */
    const  PROPERTY_DOES_NOT_EXIST = 5;

    /**
     * Method parameter to test does not exist
     */
    const METHOD_PARAMETER_DOES_NOT_EXIST = 6;

    /**
     * Ambient file indicated does not exist
     */
    const AMBIENT_FILE_DOES_NOT_EXIST = 7;

    /**
     * Ambient class does not exist
     */
    const AMBIENT_CLASS_DOES_NOT_EXIST = 8;

    /**
     * Ambient file does not return a valid instance of ambient
     */
    const AMBIENT_FILE_DOES_NOT_RETURN_A_VALID_AMBIENT_INSTANCE = 9;

    /**
     * Directory not readable
     */
    const DIRECTORY_NOT_READABLE = 10;

    /**
     * Invalid ambient, generally cause is not an instance of AmbientInterface
     */
    const AMBIENT_IS_NOT_VALID = 11;

    /**
     * Directory does not exist
     */
    const DIRECTORY_DOES_NOT_EXIST = 12;

    const AMBIENT_CLASS_DOES_NOT_EXIST = 13;

    const AMBIENT_CLASS_DOES_NOT_IMPLEMENT_AMBIENTINTERFACE = 14;
}