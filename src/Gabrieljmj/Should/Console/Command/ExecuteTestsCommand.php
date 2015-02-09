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
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Gabrieljmj\Should\Ambient\AmbientInterface;
use Gabrieljmj\Should\Template\TemplateInterface;
use Gabrieljmj\Should\Report\Report;
use Gabrieljmj\Should\Event\ExecutionEventInterface;
use Gabrieljmj\Should\Logger\LoggerAdapterInterface;
use Gabrieljmj\Should\Exception\ConsoleException;
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
     * @var \Gabrieljmj\Should\Event\ExecutionEventInterface
     */
    private $event;

    /**
     * @var array
     */
    private $runners = [];

    /**
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param \Gabrieljmj\Should\Event\ExecutionEventInterface $event
     */
    public function setEvent(ExecutionEventInterface $event)
    {
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

        $this->event->setOutput($output);
        $this->event->setReport($this->combineReports($reports));

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