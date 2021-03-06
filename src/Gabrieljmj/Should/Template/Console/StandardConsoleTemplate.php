<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Template\Console;

use Gabrieljmj\Should\Template\TemplateInterface;
use Gabrieljmj\Should\Report\Report;

class StandardConsoleTemplate implements TemplateInterface
{
    /**
     * Colors are enabled or desabled
     *
     * @var boolean
     */
    private $colors = false;
    
    /**
     * Enable colors for tests
     * 
     * @param boolean $enable
     */
    public function colors($enable = true)
    {
        $this->colors = $enable;
    }
    
    /**
     * Return the created content by determined report
     * 
     * @param \Gabrieljmj\Should\Report\Report $report
     * @return string
     */
    public function render(Report $report)
    {
        $should = " 
 ____  _   _ _____ _   _ _    _____
/  _ \| | | |  _  | | | | |  |  _  \ 
| | |_| | | | | | | | | | |  | | \ |
| |__ | |_| | | | | | | | |  | | | |
|___ \|  _  | | | | | | | |  | | | |
 _  | | | | | | | | | | | |  | | | | __      __
| | | | | | | | | | | | | |  | | | ||  \|  ||  \
| |_| | | | | |_| | |_| | |__| |_/ ||__/|__||__/
\____/|_| |_|_____|_____|____|_____/|   |  ||\n";

        $return = $this->colors ? '<comment>' . $should . '</comment>' : $should;

        if ($report->getTotal() > 0) {
            if (count($this->getFail($report))) {
                $return .= "\nREPORT\n--------------------------\n";
                $return .= implode("\n\n", $this->getFail($report));
            }

            $total = $report->getTotal();
            $success = $report->getSuccessTotal();
            $fail = $report->getFailTotal();
            $time = round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]) * 100) / 100;

            $return .= "\n\nRESULT\n--------------------------\n";
            $info = "Total: {$total}\nSuccess: {$success}\nFail: {$fail}\nExecution time: {$time}";
            $return .= $this->colors ? '<info>' . $info . '</info>' : $info;
        } else {
            $return .= "-------------------------------------------------\nNo tests executed!";
        }

        return $return;

    }

    private function getFail(Report $report)
    {
        $return = [];
        $assertList = $report->getAssertList();

        foreach ($assertList as $testType => $value) {
            if (isset($assertList[$testType]['fail'])) {
                foreach ($assertList[$testType]['fail'] as $element => $fails) {
                    $return[] = "Fail on tests of the {$testType} {$element}:\n";
                    foreach ($fails as $key => $fail) {
                        $n = $key + 1;
                        $name = $fail->getName();
                        $failmsg = $fail->getMessage() !== null ? $fail->getMessage() : $fail->getFailMessage();
                        $li = "{$n}) {$name} - {$failmsg}";
                        $return[] = $this->colors ? '<error>' . $li . '</error>' : $li;
                    }
                }
            }
        }

        return $return;
    }
}
