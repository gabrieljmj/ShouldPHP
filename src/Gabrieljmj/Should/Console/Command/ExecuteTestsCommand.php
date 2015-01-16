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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $input->hasArgument('test_name') ? $testName = $input->getArgument('test_name') : null;
        $output->writeln(" 
 ____  _   _ _____ _   _ _    _____
/  _ \| | | |  _  | | | | |  |  _  \ 
| | |_| | | | | | | | | | |  | | \ |
| |__ | |_| | | | | | | | |  | | | |
|___ \|  _  | | | | | | | |  | | | |
 _  | | | | | | | | | | | |  | | | | __      __
| | | | | | | | | | | | | |  | | | ||  \|  ||  \
| |_| | | | | |_| | |_| | |__| |_/ ||__/|__||__/
\____/|_| |_|_____|_____|____|_____/|   |  ||\n");
        $output->writeln("\nREPORT\n--------------------------\n");

        if ($this->isDir($file)) {
            $dir = $file;
            $ambientFiles = $this->getAmbientFilesFromDir($dir);

            $result = $this->executeArrayOfTests($ambientFiles, $input, $output);
        } else {
            $ext = $this->getFileExt($file);

            if ($ext === 'php') {
                $ambient = $this->validateFile($file);

                $report = $this->runTest($ambient, $input, $output);
                $total = $report['total']['total'];
                $success = $report['total']['all']['success'];
                $fail = $report['total']['all']['fail'];

                $output->writeln("\nRESULT\n--------------------------\nTotal: {$total}\nSuccess: {$success}\nFail: {$fail}");
            } elseif ($ext === 'json') {
                if (file_exists($file)) {
                    $fileContent = file_get_contents($file);
                    $json = json_decode($fileContent);
                    $ambientFiles = $json->ambients;

                    $result = $this->executeArrayOfTests($ambientFiles, $input, $output);
                    $total = $result['total'];
                    $success = $result['success'];
                    $fail = $result['fail'];
                    $output->writeln("\nRESULT\n--------------------------\nTotal: {$total}\nSuccess: {$success}\nFail: {$fail}");
                }
            }
        }

        $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
        $output->writeln('Execution time: ' . round($time * 100) / 100);
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

        $name = $report['test'];
        foreach ($report as $testType => $value) {
            if (isset($report[$testType]['fail'])) {
                foreach ($report[$testType]['fail'] as $element => $fails) {
                    $output->writeln("Fail on tests of the {$testType} {$element}:\n");
                    foreach ($fails as $key => $fail) {
                        $n = $key + 1;
                        $name = $fail['name'];
                        $failmsg = $fail['failmsg'];
                        $output->writeln("{$n}) {$name} - {$failmsg}\n");
                    }
                }
            }
        }

        return $report;
    }

    protected function executeArrayOfTests(array $ambientFiles, InputInterface $input, OutputInterface $output)
    {
        $ambients = [];
        $reportE['total'] = 0;
        $reportE['success'] = 0;
        $reportE['fail'] = 0;

        foreach ($ambientFiles as $ambientFile) {
            if ($this->isDir($ambientFile)) {
                $result = $this->executeArrayOfTests($this->getAmbientFilesFromDir($ambientFile), $input, $output);
                $reportE['total'] += $result['total'];
                $reportE['success'] += $result['success'];
                $reportE['fail'] += $result['fail'];
            } else {
                $ambients[] = $this->validateFile($ambientFile);
            }
        }

        foreach ($ambients as $ambient) {
            $report = $this->runTest($ambient, $input, $output);
            $reportE['total'] = $reportE['total'] + $report['total']['total'];
            $reportE['success'] = $reportE['success'] + $report['total']['all']['success'];
            $reportE['fail'] = $reportE['fail'] + $report['total']['all']['fail'];
        }

        return $reportE;
    }

    protected function isDir($dir)
    {
        return substr($dir, -1) == '/';
    }

    protected function getAmbientFilesFromDir($dir)
    {
        if (!is_dir($dir) || !is_readable($dir)) {
            throw new Exception('Directory not exists or is not readable: ' . $dir);
        }

        $files = scandir($dir);
        unset($files[0], $files[1]);

        foreach ($files as $key => $file) {
            $files[$key] = $dir . DIRECTORY_SEPARATOR . $file;
        }

        return $files;
    }
}