<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Event;

use Gabrieljmj\Should\Event\ExecutionEventInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Gabrieljmj\Should\Report\Report;
use Gabrieljmj\Should\Template\TemplateInterface;
use Symfony\Component\EventDispatcher\Event;

class ExecutionEvent extends Event implements ExecutionEventInterface
{
    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    private $output;

    /**
     * @var \Gabrieljmj\Should\Report\Report
     */
    private $report;

    /**
     * @var \Gabrieljmj\Should\Template\TemplateInterface
     */
    private $template;

    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param \Gabrieljmj\Should\Report\Report $report
     */
    public function setReport(Report $report)
    {
        $this->report = $report;
    }

    /**
     * @param \Gabrieljmj\Should\Template\TemplateInterface $template
     */
    public function setTemplate(TemplateInterface $template)
    {
        $this->template = $template;
    }

    /**
     * @return \Symfony\Component\Console\Output\OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @return \Gabrieljmj\Should\Report\Report
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @return \Gabrieljmj\Should\Template\TemplateInterface
     */
    public function getTemplate()
    {
        return $this->template;
    }
}