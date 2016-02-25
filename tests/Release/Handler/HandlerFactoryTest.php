<?php

namespace Release\Handler;

class HandlerFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected function assertPreConditions()
    {
        $this->assertTrue(class_exists("Release\Handler\HandlerFactory"), 'class HandlerFactory must exists');
        $this->assertTrue(class_exists("Release\Handler\AbstractHandler"), 'class AbstractHandler must exists');
    }

    public function testCreateHandler()
    {
        $factory = $this->getFactory();
        $handler = $factory->create();
        $this->assertInstanceOf("Release\Handler\AbstractHandler", $handler, 'HandlerFactory must return an AbstractHandler object');

    }

    public function testCreateDefaultHandler()
    {
        $factory = $this->getFactory();
        $handler = $factory->create();
        $this->assertInstanceOf("Release\Handler\ComposerHandler", $handler, 'HandlerFactory must return an ComposerHandler object as default');
    }

    private function getFactory()
    {
        return new HandlerFactory();
    }
}
