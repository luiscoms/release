<?php

namespace Release\IO;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamDirectory;

class ComposerIOTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var  vfsStreamDirectory
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
        $tempdir = dirname(dirname(__DIR__)) . 'tmp';
        // content, directory
        return array(
            // array('{"name": "root/path_one", "authors": [{"name": "Dev", "email": "dev@luiscoms.com.br"} ], "require": {} }', $tempdir . '/path_one')
            array('', $tempdir . '/path_one')
        );
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
    public function testLoadComposerFileContentRecursively($expected, $dir)
    {
        $hash = md5(microtime());
        $root = vfsStreamWrapper::getRoot();

        $this->assertFalse($root->hasChild($hash));

        $content = 'some content';
        $file = vfsStream::newFile('composer.json')
            ->at($root)
            ->setContent($content);
        // $this->assertEquals($content, vfsStream::url('composer.json'));
        $this->assertEquals($content, $root->getChild('composer.json')->getContent());

        $composerIO = new ComposerIO($dir);
        $composerIO->load();
        $this->assertEquals($expected, $composerIO->load());
    }
}
