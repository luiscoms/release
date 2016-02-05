<?php

namespace Release\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Current extends Command
{
    protected function configure()
    {
        $this
            ->setName('current')
            ->setDescription('Print the current application version')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('1.0.0');
    }
}
