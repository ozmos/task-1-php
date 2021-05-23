<?php

namespace App\Command;

use Controllers\DataController;
use Database\DataFactory;
use Database\Migration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PopulateDatabaseCommand extends Command
{
    protected static $defaultName = 'database:populate-database';

    protected function configure(): void
    {
        $this
            ->setDescription('Creates Tables for database and populates them with randomized data')
            ->setHelp('Sets up the schema and populates tables with dummy data.  Specify number of records to add with `number` argument');

        $this->addArgument('number', InputArgument::REQUIRED, 'number of records to insert');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // creates schema
        $migration = new Migration();
        $migration->up();

        // populate tables
        $factory = new DataFactory();
        $factory->populate($input->getArgument('number'));

        // display number of records in table
        $data = new DataController();
        $records = count($data->index());
        $output->writeln('There are ' . $records . ' records in the users table');

        return Command::SUCCESS;
    }
}
