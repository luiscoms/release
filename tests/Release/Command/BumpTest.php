<?php

namespace Release\Command;

use Release\Command\Current;
use Release\Version;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class BumpTest extends \PHPUnit_Framework_TestCase
{
    public function testUpdatePatch()
    {
        $application = new Application();
        $application->add(new Bump($this->getFactory()));

        $command = $application->find('bump');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertRegExp("/\b0\.0\.26\b/", $commandTester->getDisplay());
    }

    private function getFactory()
    {
        $handler = $this->getMockBuilder('Release\Handler\ComposerHandler')
                    ->disableOriginalConstructor()
                    ->getMock();

        $handler->expects($this->once())
             ->method('getVersion')
             ->willReturn(new Version(0, 0, 25));

        $factory = $this->getMockBuilder('Release\Handler\HandlerFactory')
                    ->getMock();

        $factory->expects($this->any())
             ->method('create')
             ->willReturn($handler);

        return $factory;
    }
}
