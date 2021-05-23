#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Database/DatabaseConnection.php';
require __DIR__ . '/src/Database/Migration.php';
require __DIR__ . '/src/Database/DataFactory.php';
require __DIR__ . '/src/Controllers/DataController.php';
require __DIR__ . '/src/Command/PopulateDatabaseCommand.php';
require __DIR__ . '/src/Command/DisplayDataCommand.php';

use App\Command\DisplayDataCommand;
use App\Command\PopulateDatabaseCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new PopulateDatabaseCommand());
$application->add(new DisplayDataCommand());

$application->run();
