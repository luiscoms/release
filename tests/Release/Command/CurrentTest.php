<?php

namespace Release\Command;

// http://symfony.com/doc/current/components/console/introduction.html
use Release\Command\Current;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CurrentTest extends \PHPUnit_Framework_TestCase
{
    public function testViewCurrentVersion()
    {
        $application = new Application();
        $application->add(new Current());

        $command = $application->find('current');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertRegExp("/1\.0\.0/", $commandTester->getDisplay());
    }
}
