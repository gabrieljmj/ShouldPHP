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

use Gabrieljmj\Should\ShouldClass;
use Gabrieljmj\Should\ShouldMethod;
use Gabrieljmj\Should\ShouldProperty;
use Gabrieljmj\Should\ShouldParameter;
use Gabrieljmj\Should\TheClass;
use Gabrieljmj\Should\TheMethod;
use Gabrieljmj\Should\TheProperty;
use Gabrieljmj\Should\TheParameter;
use Gabrieljmj\Should\Collection;
use Gabrieljmj\Should\Runner\RunnerInterface;

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
    private $name;
    
    /**
     * @var \Gabrieljmj\Should\Collection
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
     * @return \Gabrieljmj\Should\Class
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
     * @return \Gabrieljmj\Should\Method
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
     */
    public function theProperty($class, $property)
    {
        $className = $this->getClassAsString($class);
        $index = $className . ':' . $property;

        return $this->create('property', func_get_args(), $index);
    }

    public function theParameter($class, $method, $parameter)
    {
        $className = $this->getClassAsString($class);
        $index = $className . ':' . $method . ':' . $parameter;

        return $this->create('parameter', func_get_args(), $index);
    }
    
    /**
     * @{inheritDoc}
    */
    public function run()
    {
        $classAssertList = $this->createAssertList($this->classCollection);
        $methodAssertList = $this->createAssertList($this->methodCollection);
        $propertyAssertList = $this->createAssertList($this->propertyCollection);
        $parameterAssertList = $this->createAssertList($this->parameterCollection);
        
        $this->report = $this->createReport($classAssertList, $methodAssertList, $propertyAssertList, $parameterAssertList);
    }
    
    /**
     * @return \Gabrieljmj\Should\Collection
     */
    public function getReport()
    {
        return $this->report;
    }
    
    /**
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
        $report = [];
        $report['test'] = $this->getName();
        $report['total'] = [
            'total' => 0,
            'all' => ['success' => 0, 'fail' => 0],
            'class' => ['success' => 0, 'fail' => 0],
            'method' => ['success' => 0, 'fail' => 0],
            'property' => ['success' => 0, 'fail' => 0],
            'parameter' => ['success' => 0, 'fail' => 0]
        ];

        $report = $this->createReportOfSomeType('class', $classAssertList, $report);
        $report = $this->createReportOfSomeType('method', $methodAssertList, $report);
        $report = $this->createReportOfSomeType('property', $propertyAssertList, $report);
        $report = $this->createReportOfSomeType('parameter', $parameterAssertList, $report);

        return new Collection($report);
    }

    /**
     * @param string $type
     * @param array  $assertList
     * @param array  $report
     * @return array
     */
    private function createReportOfSomeType($type, array $assertList, array $report) {
        foreach ($assertList as $assert) {
            $nameEx = explode('\\', get_class($assert));
            $name = end($nameEx);
            $status = $assert->execute() ? 'success' : 'fail';
            $report[$type][$status][$assert->getTestedElement()][] = ['description' => $assert->getDescription(), 'name' => $name, 'failmsg' => $assert->getFailMessage()];
            $report['total']++;
            $report['total'][$type][$status]++;
            $report['total']['total']++;
            $report['total']['all'][$status]++;
        }

        return $report;
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