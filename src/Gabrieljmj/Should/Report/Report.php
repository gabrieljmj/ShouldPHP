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

class Report
{
    /**
     * Name of the tested ambient
     *
     * @var string
     */
    private $name;

    /**
     * Total of assertions executed
     *
     * @var integer
     */
    private $total = 0;

    /**
     * Total of successful assertions
     *
     * @var integer
     */
    private $successTotal = 0;

    /**
     * Total of unsuccessful assertions
     *
     * @var integer
     */
    private $failTotal = 0;

    /**
     * Executed assertions details
     *
     * @var array
     */
    private $assertList;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the name of the tested ambient
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Adds an assert to assert list
     *
     * @param \Gabrieljmj\Should\Report\AssertReport $report
     */
    public function addAssert(AssertReport $report)
    {
        $this->total++;
        $report->getStatus() === 'success' ? $this->successTotal++ : $this->failTotal++;
        $this->assertList[$report->getType()][$report->getStatus()][$report->getTestedElement()][] = $report;
    }

    /**
     * Returns the total of assertions executed
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Returns the total of successful assertions
     *
     * @return integer
     */
    public function getSuccessTotal()
    {
        return $this->successTotal;
    }

    /**
     * Return the total of unsuccessful assertions
     *
     * @return integer
     */
    public function getFailTotal()
    {
        return $this->failTotal;
    }

    /**
     * Returns the executed assertions
     * Each array element is an instance of \Gabrieljmj\Should\Report\ReportAssertion
     *
     * @return array
     */
    public function getAssertList()
    {
        return $this->assertList;
    }

    /**
     * Serializes the report
     *
     * @return string
     */
    public function serialize()
    {
        $report = [
            'total' => $this->getTotal(),
            'success_total' => $this->getSuccessTotal(),
            'fail_total' => $this->getFailTotal(),
            'elements' => []
        ];

        foreach ($this->getAssertList() as $type => $elements) {
            foreach ($elements as $element => $status) {
                foreach ($status as $assert) {
                    $report['elements'][$type][$element][$status][] = [
                        'name' => $assert->getName(),
                        'description' => $assert->getDescription(),
                        'fail_msg' => $assert->getFailMessage()
                    ];
                 }
            }
        }

        return serialize($report);
    }

    /**
     * Unserializes a string of a report
     *
     * @param string $str
     */
    public function unserialize($str)
    {
        return;
    }
}