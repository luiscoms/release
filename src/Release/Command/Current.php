<?php

namespace Release\Command;

use Release\Handler\HandlerFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Current extends Command
{
    private $factory;

    public function __construct(HandlerFactory $factory)
    {
        $this->factory = $factory;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('current')
            ->setDescription('Print the current application version')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $handler = $this->factory->create();
        $output->writeln((string) $handler->getVersion());
    }
}
