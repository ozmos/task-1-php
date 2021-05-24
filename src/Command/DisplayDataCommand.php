<?php

namespace App\Command;

use Models\data;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DisplayDataCommand extends Command
{
    protected static $defaultName = 'database:display-data';

    protected function configure(): void
    {
        # code...
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // display data
        $data = new data();
        $records = $data->users();

        foreach ($records as $key => $value) {
            $output->writeln('name: ' . $key);
            $output->writeln('email: ' . $value['email']);
            $output->writeln('address: ' . $value['address']);
            $output->writeln('===========');
        }


        return Command::SUCCESS;
    }
}
