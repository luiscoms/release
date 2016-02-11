<?php

namespace Release;

class Version
{
    private $_major;
    private $_minor;
    private $_patch;
    private $_preRelease;
    private $_build;

    public function __construct($major = 0, $minor = 0, $patch = 1, $preRelease = '', $build = '')
    {
        $this->_major = $major;
        $this->_minor = $minor;
        $this->_patch = $patch;
        $this->_preRelease = $preRelease;
        $this->_build = $build;
    }//end __construct()

    public function updateMajor()
    {
        $this->_major += 1;
        $this->_minor = 0;
        $this->_patch = 0;
        $this->_preRelease = $this->_build = '';
    }

    public function updateMinor()
    {
        $this->_minor += 1;
        $this->_patch = 0;
        $this->_preRelease = $this->_build = '';
    }

    public function updatePatch()
    {
        $this->_patch += 1;
        $this->_preRelease = $this->_build = '';
    }

    public function __toString()
    {
        $preRelease = (!empty($this->_preRelease) ? '-' : '') . $this->_preRelease;
        $build = (!empty($this->_build) ? '+' : '') . $this->_build;
        $versionString = $this->_major . '.' . $this->_minor . '.'  . $this->_patch . $preRelease . $build;
        return $versionString;
    }
}
