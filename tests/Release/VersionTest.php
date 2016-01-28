<?php

namespace Release;

class VersionTest extends \PHPUnit_Framework_TestCase
{
    protected function assertPreConditions()
    {
        $this->assertTrue(class_exists("Release\Version"), 'Version class does not exists');
    }

    public function testVersionDefault()
    {
        $version = new Version();

        $this->assertEquals('0.0.1', $version);
    }
}
