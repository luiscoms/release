<?php

namespace Release\Handler;

class ComposerHandlerTest extends \PHPUnit_Framework_TestCase
{
    protected function assertPreConditions()
    {
        $this->assertTrue(class_exists("Release\Handler\Handler"), 'class Handler must exists');
        $this->assertTrue(class_exists("Release\Handler\ComposerHandler"), 'class ComposerHandler must exists');
        // TODO Change to Mock of IOInterface
        $io = $this->getMockBuilder('Release\IO\ComposerIO')->disableOriginalConstructor()->getMock();
        $this->assertInstanceOf("Release\Handler\Handler", new ComposerHandler($io), 'ComposerHandler must extends Handler class');
    }

    /**
     * @dataProvider validStaticFilesProvider
     */
    public function testGetVersion($expected, $content)
    {
        $io = $this->getMockBuilder('Release\IO\ComposerIO')
                    ->disableOriginalConstructor()
                    ->getMock();

        $io->method('load')
             ->willReturn($content);
        $composerHandler = new ComposerHandler($io);
        $version = $composerHandler->getVersion();
        $this->assertInstanceOf('Release\Version', $version, 'Method getVersion should return an instance of Release\Version');
        $this->assertEquals($expected, (string) $version);
    }

    public function validStaticFilesProvider()
    {
        return array(
            array('0.0.1', '{
    "version": "0.0.1"
}')
        );
    }
}
