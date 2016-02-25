<?php

namespace Release\Command;

use Release\Handler\HandlerFactory;
use Release\IO\ComposerIO;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Bump extends Command
{
    protected function configure()
    {
        $this
            ->setName('bump')
            ->setDescription('Bump the application version')
            ->addOption(
                'patch',
                null,
                InputOption::VALUE_NONE,
                'Update the patch part of version'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $handler = HandlerFactory::create();
        $version = $handler->getVersion();
        $version->updatePatch();
        $handler->setVersion($version);
        $output->writeln((string) $version);
    }
}
