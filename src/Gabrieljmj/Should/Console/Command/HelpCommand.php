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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelpCommand extends Command
{
    protected function configure()
    {
        $this->setName('help')
             ->setDescription('Should console commands');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("\nHelp to [should:execute]:\n
    Execution:  php vendor/bin/should execute <file_or_class>\n
    Options:\n
        -s|--save <file>       Save logs of tests");
    }
}