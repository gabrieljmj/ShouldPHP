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
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    private $input;

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    private $output;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
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

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $this->input
     * @param \Symfony\Component\Console\Output\OutputInterface $this->output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $file = $this->input->getArgument('file');
        echo str_replace('/', '\\', $file);
        $this->input->hasArgument('test_name') ? $testName = $this->input->getArgument('test_name') : null;
        $this->output->writeln(" 
 ____  _   _ _____ _   _ _    _____
/  _ \| | | |  _  | | | | |  |  _  \ 
| | |_| | | | | | | | | | |  | | \ |
| |__ | |_| | | | | | | | |  | | | |
|___ \|  _  | | | | | | | |  | | | |
 _  | | | | | | | | | | | |  | | | | __      __
| | | | | | | | | | | | | |  | | | ||  \|  ||  \
| |_| | | | | |_| | |_| | |__| |_/ ||__/|__||__/
\____/|_| |_|_____|_____|____|_____/|   |  ||\n");
        $this->output->writeln("\nREPORT\n--------------------------\n");

        if ($this->isDir($file)) {
            $dir = $file;
            $ambientFiles = $this->getAmbientFilesFromDir($dir);

            $result = $this->executeArrayOfTests($ambientFiles);
            $this->showTests($result, $this->output);
        } else {
            $ext = $this->getFileExt($file);

            if ($ext === 'php') {
                $ambient = $this->validateFile($file);

                $report = $this->runTest($ambient);
                $total = $report['total']['total'];
                $success = $report['total']['all']['success'];
                $fail = $report['total']['all']['fail'];

                $this->output->writeln("\nRESULT\n--------------------------\nTotal: {$total}\nSuccess: {$success}\nFail: {$fail}");
            } elseif ($ext === 'json') {
                if (file_exists($file)) {
                    $fileContent = file_get_contents($file);
                    $json = json_decode($fileContent);
                    $ambientFiles = $json->ambients;

                    $result = $this->executeArrayOfTests($ambientFiles);
                    $this->showTests($result, $this->output);
                }
            } elseif (class_exists(str_replace('/', '\\', $file))) {
                    $file = str_replace('/', '\\', $file);
                    $report = $this->executeAmbientObject($file);
                    $total = $report['total'];
                    $success = $report['success'];
                    $fail = $report['fail'];
                    $executedMethods = $report['executedMethods'];

                    $this->output->writeln("\nRESULT\n--------------------------\nTotal: {$total}\nSuccess: {$success}\nFail: {$fail}\nExecuted methods: {$executedMethods}");
            }
        }

        $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
        $this->output->writeln('Execution time: ' . round($time * 100) / 100);
    }

    /**
     * @param string $file
     * @return string
     */
    private function getFileExt($file)
    {
        $e = explode('.', $file);
        return end($e);
    }

    /**
     * @param string $file
     * @return \Gabrieljmj\Should\AmbientInterface
     */
    private function validateFile($file)
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

    /**
     * @param \Gabrieljmj\Should\AmbientInterface $ambient
     * @return \Gabrieljmj\Should\Collection
     */
    private function runTest(AmbientInterface $ambient)
    {
        $ambient->run();
        $report = $ambient->getReport();

        if ($this->input->getOption('save')) {
            $this->logger->pushHandler(new StreamHandler($this->input->getOption('save'), Logger::INFO));
            $this->logger->info($report->serialize());
        }

        $name = $report['test'];

        foreach ($report as $testType => $value) {
            if (isset($report[$testType]['fail'])) {
                foreach ($report[$testType]['fail'] as $element => $fails) {
                    $this->output->writeln("Fail on tests of the {$testType} {$element}:\n");
                    foreach ($fails as $key => $fail) {
                        $n = $key + 1;
                        $name = $fail['name'];
                        $failmsg = $fail['failmsg'];
                        $this->output->writeln("{$n}) {$name} - {$failmsg}\n");
                    }
                }
            }
        }

        return $report;
    }

    /**
     * @param array $ambientFiles
     * @return array
     */
    private function executeArrayOfTests(array $ambientFiles)
    {
        $ambients = [];
        $reportE = [];
        $reportE['total'] = 0;
        $reportE['success'] = 0;
        $reportE['fail'] = 0;

        foreach ($ambientFiles as $ambientFile) {
            if ($this->isDir($ambientFile)) {
                $result = $this->executeArrayOfTests($this->getAmbientFilesFromDir($ambientFile));
                $reportE['total'] += $result['total'];
                $reportE['success'] += $result['success'];
                $reportE['fail'] += $result['fail'];
            } elseif (class_exists($ambientFile)) {
                $result = $this->executeAmbientObject($ambientFile);
                $reportE['total'] += $result['total'];
                $reportE['success'] += $result['success'];
                $reportE['fail'] += $result['fail'];
            } else {
                $ambients[] = $this->validateFile($ambientFile);
            }
        }

        foreach ($ambients as $ambient) {
            $report = $this->runTest($ambient);
            $reportE['total'] += $report['total']['total'];
            $reportE['success'] += $report['total']['all']['success'];
            $reportE['fail'] += $report['total']['all']['fail'];
        }

        return $reportE;
    }

    /**
     * @param string $dir
     * @return boolean
     */
    private function isDir($dir)
    {
        return substr($dir, -1) == '/';
    }

    /**
     * @param string $dir
     * @return array
     */
    private function getAmbientFilesFromDir($dir)
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

    /**
     * @param string $class
     * @return array
     */
    private function executeAmbientObject($class)
    {
        $ref = new \ReflectionClass($class);
        $methods = $ref->getMethods();
        $instance = $ref->newInstance();
        $executedMethods = 0;

        if (!$instance instanceof AmbientInterface) {
            throw new \Exception('This ambient is not a directory or a file or a object: ' . $class);
        }

        foreach ($methods as $method) {
            if ($method->isPublic()) {
                if (strtolower(substr($method->getName(), 0, 4)) === 'test') {
                    $executedMethods++;
                    call_user_func_array([$instance, $method->getName()], []);
                }
            }
        }

        $report = $this->runTest($instance);

        return [
            'total' => $report['total']['total'],
            'success' =>  $report['total']['all']['success'],
            'fail' => $report['total']['all']['fail'],
            'executedMethods' => $executedMethods
        ];
    }

    /**
     * @param array $result
     */
    private function showTests(array $result)
    {
        $total = $result['total'];
        $success = $result['success'];
        $fail = $result['fail'];
        $this->output->writeln("\nRESULT\n--------------------------\nTotal: {$total}\nSuccess: {$success}\nFail: {$fail}");
    }
}