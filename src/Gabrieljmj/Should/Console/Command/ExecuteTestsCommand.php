<?php
/**
 * ShouldPHP
 *
 * @author Gabriel Jacinto <gamjj74@hotmail.com>
 * @status dev
 * @link   https://github.com/GabrielJMJ/ShouldPHP
 */
 
namespace Gabrieljmj\Should\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Psr\Log\LogLevel;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Gabrieljmj\Should\AmbientInterface;
use \Exception;

class ExecuteTestsCommand extends Command
{
    private $logger;

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    protected function configure()
    {
        $this->setName('should:execute')
             ->setDescription('Executes tests')
             ->addArgument(
                    'file',
                    InputArgument::REQUIRED,
                    'Indicate the file that contains the tests ambients'
             )
             ->addOption(
                    'save',
                    's',
                    InputOption::VALUE_REQUIRED,
                    'Do you want to save the report?'
             );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $input->hasArgument('test_name') ? $testName = $input->getArgument('test_name') : null;
        $ext = $this->getFileExt($file);
        $testsTotal = 0;

        $output->writeln("\nREPORT\n--------------------------\n");

        if ($ext === 'php') {
            $ambient = $this->validateFile($file);

            $report = $this->runTest($ambient, $input, $output);
            $total = $report['total']['total'];
            $success = $report['total']['all']['success'];
            $fail = $report['total']['all']['fail'];

            $output->writeln("\nRESULT\n--------------------------\nTotal: {$total}\nSuccess: {$success}\nFail: {$fail}");
        } else {
            if (file_exists($file)) {
                $file = file_get_contents($file);
                $json = json_decode($file);
                $ambientFiles = $json->ambients;
                $ambients = [];

                foreach ($ambientFiles as $ambientFile) {
                    $ambients[] = $this->validateFile($ambientFile);
                }

                foreach ($ambients as $ambient) {
                    $this->runTest($ambient, $input, $output);
                }
            }
        }
    }

    protected function getFileExt($file)
    {
        $e = explode('.', $file);
        return end($e);
    }

    protected function validateFile($file)
    {
        if (!file_exists($file)) {
            throw new Exception('The file of an ambient was not found: ' . $file);
        }

        $ambientInstance = require $file;

        if (!is_object($ambientInstance) || !$ambientInstance instanceof AmbientInterface) {
            throw new Exception('The file of an ambient does not return an instance of a valid ambient');
        }

        return $ambientInstance;
    }

    protected function runTest(AmbientInterface $ambient, InputInterface $input, OutputInterface $output)
    {
        $ambient->run();
        $report = $ambient->getReport();

        if ($input->getOption('save')) {
            $this->logger->pushHandler(new StreamHandler($input->getOption('save'), Logger::INFO));
            $this->logger->info($report->serialize());
        }

        $output->writeln($report->serialize());

        return $report;
    }
}