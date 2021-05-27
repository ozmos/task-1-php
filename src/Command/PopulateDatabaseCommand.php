<?php

namespace App\Command;

use Models\Data;
use Database\DataFactory;
use Database\Migration;
use Doctrine\DBAL\Schema\Schema;
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
            ->setHelp("Sets up the schema and populates tables with dummy data.  Specify number of records to add with `number` argument. 
            Example usage to create 5 records: \n
            $~ cd path/to/project/root \n
            $~ php application.php database:populate-database 5");

        $this->addArgument('number', InputArgument::REQUIRED, 'number of records to insert');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // creates schema
        $migration = new Migration(new Schema());
        $migration->up();

        // populate tables
        $factory = new DataFactory();
        $factory->populate($input->getArgument('number'));

        // display number of records in table
        $data = new Data();
        $records = count($data->users());
        $output->writeln('There are ' . $records . ' records in the users table');

        return Command::SUCCESS;
    }
}
