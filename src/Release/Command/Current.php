<?php

namespace Release\Command;

use Release\Handler\ComposerHandler;
use Release\IO\ComposerIO;
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

        $handler = new ComposerHandler(new ComposerIO(__DIR__));
        $output->writeln((string) $handler->getVersion());
    }
}
