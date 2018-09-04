<?php

namespace Release\Command;

use Release\Event\EventManager;
use Release\Handler\HandlerFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Current extends Command
{
    private $factory;
    private $eventManager;

    public function __construct(HandlerFactory $factory, EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
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
        $this->eventManager->trigger('current', array('a', 'b', 'c'));

        $handler = $this->factory->create();
        $output->writeln((string) $handler->getVersion());
    }
}
