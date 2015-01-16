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
use Gabrieljmj\Should\TheClass;
use Gabrieljmj\Should\TheMethod;
use Gabrieljmj\Should\Collection;
use \ReflectionClass;

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
    public function __construct($name)
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
        $className = is_object($class) ? get_class($class) : $class;
        
        if (!isset($this->classCollection[$className])) {
            if (!is_object($class)) {
                $ref = new ReflectionClass($class);
                $class = $ref->newInstanceArgs($args);
            }
            
            $should = new ShouldClass($class);
            $this->classCollection[$className] = new TheClass($should);
        }
        
        return $this->classCollection[$className];
    }
    
    /**
     * @param string $class
     * @param string $method
     * @return \Gabrieljmj\Should\Method
     */
    public function theMethod($class, $method)
    {
        if (!isset($this->methodCollection[$class . ':' . $method])) {
            $should = new ShouldMethod($class, $method);
            $this->methodCollection[$class . ':' . $method] = new TheMethod($should);
        }
        
        return $this->methodCollection[$class . ':' . $method];
    }

    /**
     * @param string $class
     * @param string $property
     */
    public function theProperty($class, $property)
    {
        $className = is_object($class) ? get_class($class) : $class;
        if (!isset($this->propertyCollection[$className . ':' . $property])) {
            $should = new ShouldProperty($class, $property);
            $this->propertyCollection[$className . ':' . $property] = new TheProperty($should);
        }

        return $this->propertyCollection[$className . ':' . $property];
    }
    
    /**
     * @{inheritDoc}
    */
    public function run()
    {
        $classAssertList = [];
        $methodAssertList = [];
        $propertyAssertList =[];
        
        foreach ($this->classCollection as $class) {
            foreach ($class->should->getAssertList() as $assert) {
                $classAssertList[] = $assert;
            }
        }
        
        foreach ($this->methodCollection as $method) {
            foreach ($method->should->getAssertList() as $assert) {
                $methodAssertList[] = $assert;
            }
        }

        foreach ($this->propertyCollection as $property) {
            foreach ($property->should->getAssertList() as $assert) {
                $propertyAssertList[] = $assert;
            }
        }
        
        $this->report = $this->createReport($classAssertList, $methodAssertList, $propertyAssertList);
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
        return $this->name;
    }
    
    /**
     * @param array $classAssertList
     * @param array $methodAssertList
     * @return \Gabrieljmj\Should\Report
     */
    protected function createReport(array $classAssertList, array $methodAssertList, array $propertyAssertList)
    {
        $report = [];
        $report['test'] = $this->getName();
        $report['total'] = [
            'total' => 0,
            'all' => ['success' => 0, 'fail' => 0],
            'class' => ['success' => 0, 'fail' => 0],
            'method' => ['success' => 0, 'fail' => 0],
            'property' => ['success' => 0, 'fail' => 0]
        ];

        $report = $this->createReportOfSomeType('class', $classAssertList, $report);
        $report = $this->createReportOfSomeType('method', $methodAssertList, $report);
        $report = $this->createReportOfSomeType('property', $propertyAssertList, $report);

        return new Collection($report);
    }

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
}