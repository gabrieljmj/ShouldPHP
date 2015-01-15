#!/usr/bin/env php
<?php
require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Gabrieljmj\Should\Console\Command\ExecuteTestsCommand;
use Gabrieljmj\Should\Console\Command\HelpCommand;
use Monolog\Logger;

$command = new ExecuteTestsCommand();
$command->setLogger(new Logger('tests'));
$app = new Application();
$app->add($command);
$app->add(new HelpCommand());
$app->run();