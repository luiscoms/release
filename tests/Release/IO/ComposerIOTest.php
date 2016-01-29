<?php

namespace Release\IO;

class ComposerIOTest extends \PHPUnit_Framework_TestCase
{

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
        $composerIO = new ComposerIO($dir);
        $composerIO->load();
        $this->assertEquals($expected, $composerIO->load());
    }
}
