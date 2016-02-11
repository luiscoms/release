<?php

namespace Release\Handler;

class ComposerHandlerTest extends \PHPUnit_Framework_TestCase
{
    protected function assertPreConditions()
    {
        $this->assertTrue(class_exists("Release\Handler\Handler"), 'class Handler must exists');
        $this->assertTrue(class_exists("Release\Handler\ComposerHandler"), 'class ComposerHandler must exists');
        $io = $this->getMockBuilder('Release\IO\ComposerIO')->disableOriginalConstructor()->getMock();
        $this->assertInstanceOf("Release\Handler\Handler", new ComposerHandler($io), 'ComposerHandler must extends Handler class');
    }

    /**
     * @dataProvider validStaticFilesProvider
     */
    public function testGetVersion($expected, $content)
    {
        $io = $this->getIOInstance($content);
        $composerHandler = new ComposerHandler($io);

        $version = $composerHandler->getVersion();
        $this->assertInstanceOf('Release\Version', $version, 'Method getVersion should return an instance of Release\Version');

        $this->assertEquals($expected, (string) $version);
    }

    private function getIOInstance($content)
    {
        // TODO Change to Mock of IOInterface
        $io = $this->getMockBuilder('Release\IO\ComposerIO')
                    ->disableOriginalConstructor()
                    ->getMock();

        $io->method('load')
             ->willReturn($content);

        return $io;
    }

    public function validStaticFilesProvider()
    {
        return include dirname(dirname(__DIR__)).'/fixtures/valid/static/composerhandler.php';
    }
}