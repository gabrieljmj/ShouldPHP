<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */
 
namespace Gabrieljmj\Should\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Gabrieljmj\Should\Ambient\AmbientInterface;
use Gabrieljmj\Should\Template\TemplateInterface;
use Gabrieljmj\Should\Report\Report;
use Gabrieljmj\Should\Event\ExecutionEventInterface;
use Gabrieljmj\Should\Logger\LoggerAdapterInterface;
use Gabrieljmj\Should\Runner\RunnerInterface;

class ExecuteTestsCommand extends Command
{
    /**
     * @var \Gabrieljmj\Should\Logger\LoggerAdapterInterface
     */
    private $logger;

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var \Symfony\Component\EventDispatcher\Event
     */
    private $event;

    /**
     * @var array
     */
    private $runners = [];
    
    /**
     * @var \Gabrieljmj\Should\Template\TemplateInterface
     */
    private $template;

    /**
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
    
    /**
     * @param \Gabrieljmj\Should\Template\TemplateInterface $template
     */
    public function setTemplate(TemplateInterface $template)
    {
        $this->template = $template;
    }

    /**
     * @param \Symfony\Component\EventDispatcher\Event $event
     */
    public function setEvent(Event $event)
    {
        if (!$event instanceof ExecutionEventInterface) {
            throw new \InvalidArgumentException('Argument passed shoud be instance of ExecutionEventInterface');
        }

        $this->event = $event;
    }

    public function pushRunners($runners)
    {
        if (is_array($runners)) {
            foreach ($runners as $runner) {
                if (!$runner instanceof RunnerInterface) {
                    throw new \InvalidArgumentException('A runner passed is not instance of RunnerInterface');
                }

                if (!in_array($runner, $this->runners)) {
                    $this->runners[] = $runner;
                }
            }

            return;
        }

        if (!$runners instanceof RunnerInterface) {
            throw new \InvalidArgumentException('A runner passed is not instance of RunnerInterface');
        }

        if (!in_array($runners, $this->runners)) {
            $this->runners[] = $runner;
        }
    }

    /**
     * @param \Gabrieljmj\Should\Logger\LoggerAdapterInterface $logger
     */
    public function setLogger(LoggerAdapterInterface $logger)
    {
        if (!$logger instanceof LoggerInterface) {
            throw new \Exception('Logger should impements Psr\Log\LoggerInterface');
        }

        $this->logger = $logger;
    }

    protected function configure()
    {
        $this->setName('execute')
             ->setDescription('Executes tests')
             ->addArgument(
                    'file',
                    InputArgument::REQUIRED,
                    'Indicate the file or the path that contains the tests ambients'
             )
             ->addOption(
                    'save',
                    's',
                    InputOption::VALUE_REQUIRED,
                    'Do you want to save the report?'
             )
             ->addOption(
                    'colors',
                    'c',
                    InputOption::VALUE_NONE,
                    'Show your report with colors?'
             );
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $input->hasArgument('test_name') ? $testName = $input->getArgument('test_name') : null;
        $reports = [];

        foreach ($this->runners as $runner) {
            if ($runner->canHandle($file)) {
                $runner->run($file);
                $reports[] = $runner->getReport();
            }
        }

        if ($input->getOption('colors')) {
            $this->template->colors();
        }
        
        $this->event->setOutput($output);
        $this->event->setTemplate($this->template);
        $this->event->setReport($report = $this->combineReports($reports));

        if ($local = $input->getOption('save')) {
            $this->logger->setFile($local);
            $this->logger->info($report->serialize());
        }

        $this->eventDispatcher->dispatch('should.execute', $this->event);
    }

    private function combineReports($reports)
    {
        $finalReport = new Report('all_tests');

        foreach ($reports as $report) {
            $assertList = $report->getAssertList();

            foreach ($assertList as $testType => $value) {
                if (isset($assertList[$testType]['fail'])) {
                    foreach ($assertList[$testType]['fail'] as $element => $fails) {
                        foreach ($fails as $fail) {
                            $finalReport->addAssert($fail);
                        }
                    }
                }

                if (isset($assertList[$testType]['success'])) {
                    foreach ($assertList[$testType]['success'] as $element => $successes) {
                        foreach ($successes as $success) {
                            $finalReport->addAssert($success);
                        }
                    }
                }
            }
        }

        return $finalReport;
    }
}