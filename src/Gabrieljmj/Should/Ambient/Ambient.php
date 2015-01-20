<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Ambient;

use Gabrieljmj\Should\Ambient\AmbientInterface;
use Gabrieljmj\Should\ShouldClass;
use Gabrieljmj\Should\ShouldMethod;
use Gabrieljmj\Should\ShouldProperty;
use Gabrieljmj\Should\ShouldParameter;
use Gabrieljmj\Should\TheClass;
use Gabrieljmj\Should\TheMethod;
use Gabrieljmj\Should\TheProperty;
use Gabrieljmj\Should\TheParameter;
use Gabrieljmj\Should\Report\Report;
use Gabrieljmj\Should\Report\AssertReport;
use Gabrieljmj\Should\Report\AssertType;

class Ambient implements AmbientInterface
{
    /**
     * @var array
     */
    private $classCollection = [];
    
    /**
     * @var array
     */
    private $methodCollection = [];
    
    /**
     * @var array
     */
    private $propertyCollection = [];

    /**
     * @var array
     */
    private $parameterCollection = [];

    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var \Gabrieljmj\Should\Report\Report
     */
    private $report;
    
    /**
     * @param string $name
     */
    public function __construct($name = null)
    {
        $this->name = $name;
    }
    
    /**
     * @param string|object $class
     * @param array         $args
     * @return \Gabrieljmj\Should\TheClass
     */
    public function theClass($class, array $args = [])
    {
        $className = $this->getClassAsString($class);

        if (!is_object($class)) {
            $ref = new \ReflectionClass($class);
            $class = $ref->newInstanceArgs($args);
        }
        
        return $this->create('class', [$class], $className);
    }
    
    /**
     * @param string|object $class
     * @param string        $method
     * @return \Gabrieljmj\Should\TheMethod
     */
    public function theMethod($class, $method)
    {
        $className = $this->getClassAsString($class);
        $index = $className . ':' . $method;

        return $this->create('method', func_get_args(), $index);
    }

    /**
     * @param string|object  $class
     * @param string         $property
     * @return \Gabrieljmj\Should\TheProperty
     */
    public function theProperty($class, $property)
    {
        $className = $this->getClassAsString($class);
        $index = $className . ':' . $property;

        return $this->create('property', func_get_args(), $index);
    }

    /**
     * @param string|object $class
     * @param string        $method
     * @param string        $parameter
     * @return \Gabrieljmj\Should\TheParameter
     */
    public function theParameter($class, $method, $parameter)
    {
        $className = $this->getClassAsString($class);
        $index = $className . ':' . $method . ':' . $parameter;

        return $this->create('parameter', func_get_args(), $index);
    }
    
    /**
     * Runs the tests and create the report
     */
    public function run()
    {
        $classAssertList = $this->createAssertList($this->classCollection);
        $methodAssertList = $this->createAssertList($this->methodCollection);
        $propertyAssertList = $this->createAssertList($this->propertyCollection);
        $parameterAssertList = $this->createAssertList($this->parameterCollection);
        
        $this->createReport($classAssertList, $methodAssertList, $propertyAssertList, $parameterAssertList);
    }
    
    /**
     * Returns the ambient tests report
     *
     * @param \Gabrieljmj\Should\Report\Report
     */
    public function getReport()
    {
        return $this->report;
    }
    
    /**
     * Returns the ambient name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name === null ? get_class($this) : $this->name;
    }
    
    /**
     * @param array $classAssertList
     * @param array $methodAssertList
     * @return \Gabrieljmj\Should\Report
     */
    private function createReport(array $classAssertList, array $methodAssertList, array $propertyAssertList, array $parameterAssertList)
    {
        if (!$this->report instanceof Report) {
            $this->report = new Report($this->getName());
        }

        $this->createReportOfSomeType(AssertType::CLASS_T, $classAssertList);
        $this->createReportOfSomeType(AssertType::METHOD_T, $methodAssertList);
        $this->createReportOfSomeType(AssertType::PROPERTY_T, $propertyAssertList);
        $this->createReportOfSomeType(AssertType::PARAMETER_T, $parameterAssertList);
    }

    /**
     * @param string $type
     * @param array  $assertList
     */
    private function createReportOfSomeType($type, array $assertList) {
        foreach ($assertList as $assert) {
            $assertReport = new AssertReport($type, $assert);
            $this->report->addAssert($assertReport);
        }
    }

    /**
     * @param string|object $class
     * @return string
     */
    private function getClassAsString($class)
    {
        return is_object($class) ? get_class($class) : $class;
    }

    private function createAssertList(array $collection)
    {
        $assertList = [];

        foreach ($collection as $item) {
            foreach ($item->should->getAssertList() as $assert) {
                $assertList[] = $assert;
            }
        }

        return $assertList;
    }

    private function create($param, array $shouldParams, $index)
    {
        $shouldClass = '\Gabrieljmj\Should\Should' . ucfirst($param);
        $typeClass = '\Gabrieljmj\Should\The' . ucfirst($param);
        $collectionVarName = strtolower($param) . 'Collection';

        if (!isset($this->{$collectionVarName}[$index])) {
            $shoudlRef = new \ReflectionClass($shouldClass);
            $should = $shoudlRef->newInstanceArgs($shouldParams);
            $typeRef = new \ReflectionClass($typeClass);

            $this->{$collectionVarName}[$index] = $typeRef->newInstance($should);
        }

        return $this->{$collectionVarName}[$index];
    }
}