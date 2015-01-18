<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Template;

use Gabrieljmj\Should\Template\TemplateInterface;
use Gabrieljmj\Should\Collection;

class StandardTemplate implements TemplateInterface
{
    public function render(Collection $report)
    {var_dump($report);
        $return = " 
 ____  _   _ _____ _   _ _    _____
/  _ \| | | |  _  | | | | |  |  _  \ 
| | |_| | | | | | | | | | |  | | \ |
| |__ | |_| | | | | | | | |  | | | |
|___ \|  _  | | | | | | | |  | | | |
 _  | | | | | | | | | | | |  | | | | __      __
| | | | | | | | | | | | | |  | | | ||  \|  ||  \
| |_| | | | | |_| | |_| | |__| |_/ ||__/|__||__/
\____/|_| |_|_____|_____|____|_____/|   |  ||\n";

        if (count($this->getFail($report))) {
            $return .= "\nREPORT\n--------------------------\n";
            $return .= implode("\n\n", $this->getFail($report));
        }

        $total = $report['total']['total'];
        $success = $report['total']['all']['success'];
        $fail = $report['total']['all']['fail'];
        $time = round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]) * 100) / 100;

        $return .= "\n\nRESULT\n--------------------------\nTotal: {$total}\nSuccess: {$success}\nFail: {$fail}\nExecution time: {$time}";

        return $return;
    }

    private function getFail(Collection $report)
    {
        $return = [];

        foreach ($report as $testType => $value) {
            if (isset($report[$testType]['fail'])) {
                foreach ($report[$testType]['fail'] as $element => $fails) {
                    $return[] = "Fail on tests of the {$testType} {$element}:\n";
                    foreach ($fails as $key => $fail) {
                        $n = $key + 1;
                        $name = $fail['name'];
                        $failmsg = $fail['failmsg'];
                        $return[] = "{$n}) {$name} - {$failmsg}";
                    }
                }
            }
        }

        return $return;
    }
}
