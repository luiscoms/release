<?php

namespace Release;

class VersionTest extends \PHPUnit_Framework_TestCase
{
    public function versionsProvider()
    {
        // expected MAJOR.MINOR.PATCH pre-release Build
        return array(
            array('0.0.1-alpha', 0, 0, 1, 'alpha', ''),
            array('0.1.1-alpha.1+123', 0, 1, 1, 'alpha.1', '123'),
            array('1.0.1-beta+33', 1, 0, 1, 'beta', '33'),
            array('1.1.3', 1, 1, 3, '', ''),
            array('2.0.3-beta.11', 2, 0, 3, 'beta.11', ''),
            array('1.0.0-rc.1', 1, 0, 0, 'rc.1', ''),
            array('0.4.7-rc.21+33', 0, 4, 7, 'rc.21', '33'),
            array('1.11.33-0.3.7+20130313144700', 1, 11, 33, '0.3.7', 20130313144700),
            array('4.8.55-x.7.z.92+exp.sha.5114f85', 4, 8, 55, 'x.7.z.92', 'exp.sha.5114f85')
        );
    }

    public function updateMajorProvider()
    {
        // expected MAJOR.MINOR.PATCH pre-release Build
        return array(
            array('1.0.0', 0, 0, 1, 'alpha', ''),
            array('1.0.0', 0, 1, 1, 'alpha.1', '123'),
            array('2.0.0', 1, 0, 1, 'beta', '33'),
            array('2.0.0', 1, 1, 3, '', ''),
            array('3.0.0', 2, 0, 3, 'beta.11', ''),
            array('2.0.0', 1, 0, 0, 'rc.1', ''),
            array('1.0.0', 0, 4, 7, 'rc.21', '33'),
            array('2.0.0', 1, 11, 33, '0.3.7', 20130313144700),
            array('5.0.0', 4, 8, 55, 'x.7.z.92', 'exp.sha.5114f85')
        );
    }

    public function updateMinorProvider()
    {
        // expected MAJOR.MINOR.PATCH pre-release Build
        return array(
            array('0.1.0', 0, 0, 1, 'alpha', ''),
            array('0.2.0', 0, 1, 1, 'alpha.1', '123'),
            array('1.1.0', 1, 0, 1, 'beta', '33'),
            array('1.2.0', 1, 1, 3, '', ''),
            array('2.1.0', 2, 0, 3, 'beta.11', ''),
            array('1.1.0', 1, 0, 0, 'rc.1', ''),
            array('0.5.0', 0, 4, 7, 'rc.21', '33'),
            array('1.12.0', 1, 11, 33, '0.3.7', 20130313144700),
            array('4.9.0', 4, 8, 55, 'x.7.z.92', 'exp.sha.5114f85')
        );
    }

    public function updatePatchProvider()
    {
        // expected MAJOR.MINOR.PATCH pre-release Build
        return array(
            array('0.0.2', 0, 0, 1, 'alpha', ''),
            array('0.1.2', 0, 1, 1, 'alpha.1', '123'),
            array('1.0.2', 1, 0, 1, 'beta', '33'),
            array('1.1.4', 1, 1, 3, '', ''),
            array('2.0.4', 2, 0, 3, 'beta.11', ''),
            array('1.0.1', 1, 0, 0, 'rc.1', ''),
            array('0.4.8', 0, 4, 7, 'rc.21', '33'),
            array('1.11.34', 1, 11, 33, '0.3.7', 20130313144700),
            array('4.8.56', 4, 8, 55, 'x.7.z.92', 'exp.sha.5114f85')
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
    public function testToString($expected, $major, $minor, $patch, $preRelease, $build)
    {
        $version = new Version($major, $minor, $patch, $preRelease, $build);
        $this->assertEquals($expected, $version);
    }

    /**
     * @dataProvider updateMajorProvider
     */
    public function testUpdateMajor($expected, $major, $minor, $patch, $preRelease, $build)
    {
        $version = new Version($major, $minor, $patch, $preRelease, $build);
        $version->updateMajor();
        $this->assertEquals($expected, $version);
    }

    /**
     * @dataProvider updateMinorProvider
     */
    public function testUpdateMinor($expected, $major, $minor, $patch, $preRelease, $build)
    {
        $version = new Version($major, $minor, $patch, $preRelease, $build);
        $version->updateMinor();
        $this->assertEquals($expected, $version);
    }

    /**
     * @dataProvider updatePatchProvider
     */
    public function testUpdatePatch($expected, $major, $minor, $patch, $preRelease, $build)
    {
        $version = new Version($major, $minor, $patch, $preRelease, $build);
        $version->updatePatch();
        $this->assertEquals($expected, $version);
    }
}
