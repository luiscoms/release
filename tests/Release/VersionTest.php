<?php

namespace Release;

class VersionTest extends \PHPUnit_Framework_TestCase
{
    public function versionsProvider()
    {
        // MAJOR.MINOR.PATCH pre-release Build
        return array(
            array(0, 0, 1, 'alpha', ''),
            array(0, 1, 1, 'alpha.1', '123'),
            array(1, 0, 1, 'beta', '33'),
            array(1, 1, 3, '', ''),
            array(2, 0, 3, 'beta.11', ''),
            array(1, 0, 0, 'rc.1', ''),
            array(0, 4, 7, 'rc.21', '33'),
            array(1, 11, 33, '0.3.7', 20130313144700),
            array(4, 8, 55, 'x.7.z.92', 'exp.sha.5114f85')
        );
    }

    protected function assertPreConditions()
    {
        $this->assertTrue(class_exists("Release\Version"), 'Version class does not exists');
    }

    public function testDefaultVersion()
    {
        $version = new Version();

        $this->assertEquals('0.0.1', $version);
    }

    /**
     * @dataProvider versionsProvider
     */
    public function testToString($major, $minor, $patch, $preRelease, $build)
    {
        $version = new Version($major, $minor, $patch, $preRelease, $build);
        $preRelease = (!empty($preRelease) ? '-' : '') . $preRelease;
        $build = (!empty($build) ? '+' : '') . $build;
        $versionString = $major . '.' . $minor . '.' . $patch . $preRelease . $build;
        $this->assertEquals($versionString, $version);
    }

    /**
     * @dataProvider versionsProvider
     */
    public function testUpdateMajor($major, $minor, $patch, $preRelease, $build)
    {
        $version = new Version($major, $minor, $patch, $preRelease, $build);
        $version->updateMajor();

        $preRelease = (!empty($preRelease) ? '-' : '') . $preRelease;
        $build = (!empty($build) ? '+' : '') . $build;
        $versionString = ($major + 1) . '.0.0' . $preRelease . $build;

        $this->assertEquals($versionString, $version);
    }

    /**
     * @dataProvider versionsProvider
     */
    public function testUpdateMinor($major, $minor, $patch, $preRelease, $build)
    {
        $version = new Version($major, $minor, $patch, $preRelease, $build);
        $version->updateMinor();

        $preRelease = (!empty($preRelease) ? '-' : '') . $preRelease;
        $build = (!empty($build) ? '+' : '') . $build;
        $versionString = $major . '.' . ($minor + 1) . '.0' . $preRelease . $build;

        $this->assertEquals($versionString, $version);
    }

    /**
     * @dataProvider versionsProvider
     */
    public function testUpdatePatch($major, $minor, $patch, $preRelease, $build)
    {
        $version = new Version($major, $minor, $patch, $preRelease, $build);
        $version->updatePatch();

        $preRelease = (!empty($preRelease) ? '-' : '') . $preRelease;
        $build = (!empty($build) ? '+' : '') . $build;
        $versionString = $major . '.' . $minor . '.' . ($patch + 1) . $preRelease . $build;

        $this->assertEquals($versionString, $version);
    }
}
