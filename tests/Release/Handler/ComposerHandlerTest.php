<?php

namespace Release\Handler;

class ComposerHandlerTest extends \PHPUnit_Framework_TestCase
{
    protected function assertPreConditions()
    {
        $this->assertTrue(class_exists("Release\Handler\AbstractHandler"), 'class AbstractHandler must exists');
        $this->assertTrue(class_exists("Release\Handler\ComposerHandler"), 'class ComposerHandler must exists');
        $io = $this->getMockBuilder('Release\IO\ComposerIO')->disableOriginalConstructor()->getMock();
        $this->assertInstanceOf("Release\Handler\AbstractHandler", new ComposerHandler($io), 'ComposerHandler must extends AbstractHandler class');
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

    /**
     * @dataProvider invalidNotJSONFilesProvider
     */
    public function testGetVersionWithInvalidComposerFile($content)
    {
        $this->setExpectedExceptionRegExp('Release\Handler\Exception\HandlerException', '/Couldn\'t parse version.*/');
        $io = $this->getIOInstance($content);
        $composerHandler = new ComposerHandler($io);
        $version = $composerHandler->getVersion();
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

    public function invalidNotJSONFilesProvider()
    {
        return include dirname(dirname(__DIR__)).'/fixtures/invalid/not_json/composerhandler.php';
    }
}
