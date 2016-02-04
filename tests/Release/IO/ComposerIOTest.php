<?php

namespace Release\IO;

use Release\Version;
use org\bovigo\vfs\vfsStream;

class ComposerIOTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var org\bovigo\vfs\vfsStreamDirectory
     */
    private $root;

    /**
     * set up test environment
     */
    public function setUp()
    {
        $this->root = vfsStream::setup();
    }

    public function validStaticFilesProvider()
    {
        return include dirname(dirname(__DIR__)).'/fixtures/valid/static/composerio_structures.php';
    }

    public function invalidFilesProvider()
    {
        return include dirname(dirname(__DIR__)).'/fixtures/invalid/composerio_structures.php';
    }

    public function validFilesToUpdateProvider()
    {
        return include dirname(dirname(__DIR__)).'/fixtures/valid/save/composerio_structures.php';
    }

    protected function assertPreConditions()
    {
        $this->assertTrue(interface_exists("Release\IO\IO"), 'interface IO must exists');
        $this->assertTrue(class_exists("Release\IO\ComposerIO"), 'class ComposerIO must exists');
        $this->assertInstanceOf("Release\IO\IO", new ComposerIO(__DIR__), 'ComposerIO must implements IO interface');
    }

    /**
     * @dataProvider validStaticFilesProvider
     */
    public function testLoadComposerFileContentRecursively($expected, $baseStructure, $projectRoot, $fromDir)
    {
        vfsStream::copyFromFileSystem($baseStructure);

        $fullPath = sprintf('%s/%s/%s', $this->root->getName(), $projectRoot, $fromDir);
        $composerIO = new ComposerIO(vfsStream::url($fullPath));
        $this->assertEquals($expected, $composerIO->load());
    }

    /**
     * @dataProvider invalidFilesProvider
     */
    public function testMissingComposerFile($expected, $baseStructure, $projectRoot, $fromDir)
    {
        $this->setExpectedExceptionRegExp('Release\IO\Exception\IOException', '/composer.json not found.*/');
        vfsStream::copyFromFileSystem($baseStructure);

        $fullPath = sprintf('%s/%s/%s', $this->root->getName(), $projectRoot, $fromDir);
        $composerIO = new ComposerIO(vfsStream::url($fullPath));
        // $composerIO = new ComposerIO(vfsStream::url(sprintf('%s/%s', $this->root->getName(), $projectRoot)));
        $this->assertEquals($expected, $composerIO->load());
    }

    /**
     * @dataProvider validStaticFilesProvider
     */
    public function testSaveVersionToComposerFile($expected, $baseStructure, $projectRoot, $fromDir)
    {
        // assert that content is saved to composer file
    }
}
