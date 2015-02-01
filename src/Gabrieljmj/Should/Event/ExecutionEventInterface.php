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

use Symfony\Component\Console\Output\OutputInterface;
use Gabrieljmj\Should\Report\Report;

interface ExecutionEventInterface
{
    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function setOutput(OutputInterface $output);

    /**
     * @param \Gabrieljmj\Should\Report\Report $report
     */
    public function setReport(Report $report);

    /**
     * @return \Symfony\Component\Console\Output\OutputInterface
     */
    public function getOutput();

    /**
     * @return \Gabrieljmj\Should\Report\Report
     */
    public function getReport();

    /**
     * @return \gabrieljmj\Should\Template\TemplateInterface
     */
    public function getTemplate();
}