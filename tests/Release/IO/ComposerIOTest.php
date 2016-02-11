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

    public function invalidMissingFilesProvider()
    {
        return include dirname(dirname(__DIR__)).'/fixtures/invalid/missing/composerio_structures.php';
    }

    public function validFilesToUpdateProvider()
    {
        return include dirname(dirname(__DIR__)).'/fixtures/valid/save/composerio_structures.php';
    }

    public function invalidFilesWithoutPermissionProvider()
    {
        return include dirname(dirname(__DIR__)).'/fixtures/invalid/perms/composerio_structures.php';
    }

    protected function assertPreConditions()
    {
        $this->assertTrue(interface_exists("Release\IO\IOInterface"), 'interface IOInterface must exists');
        $this->assertTrue(class_exists("Release\IO\ComposerIO"), 'class ComposerIO must exists');
        $this->assertInstanceOf("Release\IO\IOInterface", new ComposerIO(__DIR__), 'ComposerIO must implements IOInterface interface');
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
     * @dataProvider invalidMissingFilesProvider
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
     * @dataProvider validFilesToUpdateProvider
     */
    public function testSaveDataToComposerFile($expected, $baseStructure, $projectRoot, $fromDir)
    {
        // assert that content is saved to composer file
        vfsStream::copyFromFileSystem($baseStructure);
        $fullPath = sprintf('%s/%s/%s', $this->root->getName(), $projectRoot, $fromDir);
        $composerIO = new ComposerIO(vfsStream::url($fullPath));
        $composerIO->save($expected);
        $this->assertEquals($expected, $composerIO->load());
    }

    /**
     * @dataProvider invalidFilesWithoutPermissionProvider
     */
    public function testPermissionDeniedWhenSaveComposerFile($expected, $baseStructure, $projectRoot, $fromDir)
    {
        $this->setExpectedExceptionRegExp('Release\IO\Exception\IOException', $expected);
        vfsStream::copyFromFileSystem($baseStructure);
        $fullPath = sprintf('%s/%s/%s', $this->root->getName(), $projectRoot, $fromDir);
        $composerIO = new ComposerIO(vfsStream::url($fullPath));
        $composerIO->save($expected);
    }
}
