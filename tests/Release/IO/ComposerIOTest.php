<?php

namespace Release\IO;

use org\bovigo\vfs\vfsStream;

class ComposerIOTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var org\bovigo\vfs\vfsStreamDirectory
     */
    private $root;

    /**
     * set up test environmemt
     */
    public function setUp()
    {
        $this->root = vfsStream::setup();
    }

    public function validFilesProvider()
    {
        return include dirname(dirname(__DIR__)).'/fixtures/valid/composerio_structures.php';
    }

    protected function assertPreConditions()
    {
        $this->assertTrue(interface_exists("Release\IO\IO"), 'interface IO must exists');
        $this->assertTrue(class_exists("Release\IO\ComposerIO"), 'class ComposerIO must exists');
        $this->assertInstanceOf("Release\IO\IO", new ComposerIO(__DIR__), 'ComposerIO must implements IO interface');
    }

    /**
     * @dataProvider validFilesProvider
     */
    public function testLoadComposerFileContentRecursively($expected, $projectRoot, $fromDir)
    {
        vfsStream::copyFromFileSystem(dirname(dirname(__DIR__)).'/fixtures/valid/');

        $fullPath = sprintf('%s/%s/%s', $this->root->getName(), $projectRoot, $fromDir);
        $composerIO = new ComposerIO(vfsStream::url($fullPath));
        // $composerIO = new ComposerIO(vfsStream::url(sprintf('%s/%s', $this->root->getName(), $projectRoot)));
        $this->assertEquals($expected, $composerIO->load());
    }
}
