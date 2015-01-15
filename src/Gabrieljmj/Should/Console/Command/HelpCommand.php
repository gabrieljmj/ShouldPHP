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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelpCommand extends Command
{
    protected function configure()
    {
        $this->setName('should:help')
             ->setDescription('Should console commands');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("\n\Help to [should:execute]:\n
    Execution:  should:execute [should_config_file]\n
    Options:\n
        -s|--save [log_file]       Save logs of tests");
    }
}