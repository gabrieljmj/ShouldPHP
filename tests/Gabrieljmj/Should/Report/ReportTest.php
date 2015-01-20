<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Test\Gabrieljmj\Should\Report;

use Gabrieljmj\Should\Report\Report;

class ReportTest extends \PHPUnit_Framework_TestCase
{
    public function testGettingNameIndicatedOnConstructor()
    {
        $name = 'foo';
        $report = new Report($name);

        $this->assertEquals($name, $report->getName());
    }

    public function testCoutingTotal()
    {
        $assertRep = $this
            ->getMockBuilder('\Gabrieljmj\Should\Report\AssertReport')
            ->disableOriginalConstructor()
            ->getMock();
        $report = new Report('name');
        $report->addAssert($assertRep);
        $report->addAssert($assertRep);

        $this->assertEquals(2, $report->getTotal());
    }

    public function testCountingSuccessTotal()
    {
        $success = $this->getMockFromAssertReportWithStatus('success');
        $fail = $this->getMockFromAssertReportWithStatus('fail');

        $report = new Report('name');
        $report->addAssert($success);
        $report->addAssert($fail);
        $report->addAssert($success);

        $this->assertEquals(2, $report->getSuccessTotal());
    }

    public function testCountingFailTotal()
    {
        $success = $this->getMockFromAssertReportWithStatus('success');
        $fail = $this->getMockFromAssertReportWithStatus('fail');

        $report = new Report('name');
        $report->addAssert($fail);
        $report->addAssert($success);
        $report->addAssert($fail);

        $this->assertEquals(2, $report->getFailTotal());
    }

    public function testAssertList()
    {
        $success = $this->getMockFromAssertReportWithStatus('success');
        $success
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue('class'));
        $success
            ->expects($this->any())
            ->method('getTestedElement')
            ->will($this->returnValue('stdClass'));

        $fail = $this->getMockFromAssertReportWithStatus('fail');
        $fail
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue('property'));
        $fail
            ->expects($this->any())
            ->method('getTestedElement')
            ->will($this->returnValue('stdClass::$foo'));

        $arr = [
            'class' => [
                'success' => [
                    'stdClass' => [
                        $success
                    ]
                ]
            ],
            'property' => [
                'fail' => [
                    'stdClass::$foo' => [
                        $fail
                    ]
                ]
            ]
        ];

        $report = new Report('name');
        $report->addAssert($success);
        $report->addAssert($fail);

        $this->assertEquals($arr, $report->getAssertList());
    }

    private function getMockFromAssertReportWithStatus($status)
    {
        $mock = $this
            ->getMockBuilder('\Gabrieljmj\Should\Report\AssertReport')
            ->disableOriginalConstructor()
            ->getMock();
        $mock
            ->expects($this->any())
            ->method('getStatus')
            ->will($this->returnValue($status));

        return $mock;
    }
}