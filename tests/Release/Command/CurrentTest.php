<?php

namespace Release\Command;

// http://symfony.com/doc/current/components/console/introduction.html
use Release\Command\Current;
use Release\Version;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CurrentTest extends \PHPUnit_Framework_TestCase
{
    public function testViewCurrentVersion()
    {
        $application = new Application();
        $application->add(new Current($this->getFactory()));

        $command = $application->find('current');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertRegExp("/0\.0\.1/", $commandTester->getDisplay());
    }

    private function getFactory()
    {
        $handler = $this->getMockBuilder('Release\Handler\ComposerHandler')
                    ->disableOriginalConstructor()
                    ->getMock();

        $handler->expects($this->any())
             ->method('getVersion')
             ->willReturn(new Version(0, 0, 1));

        $factory = $this->getMockBuilder('Release\Handler\HandlerFactory')
                    ->getMock();

        $factory->expects($this->any())
             ->method('create')
             ->willReturn($handler);

        return $factory;
    }
}
