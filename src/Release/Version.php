<?php

namespace Release;

class Version
{
    private $major;
    private $minor;
    private $patch;
    private $preRelease;
    private $build;

    public function __construct($major = 0, $minor = 0, $patch = 1, $preRelease = '', $build = '')
    {
        $this->major = $major;
        $this->minor = $minor;
        $this->patch = $patch;
        $this->preRelease = $preRelease;
        $this->build = $build;
    }

    public function updateMajor()
    {
        $this->major += 1;
        $this->minor = 0;
        $this->patch = 0;
    }

    public function updateMinor()
    {
        $this->minor += 1;
        $this->patch = 0;
    }

    public function updatePatch()
    {
        $this->patch += 1;
    }

    public function __toString()
    {
        $preRelease = (!empty($this->preRelease) ? '-' : '') . $this->preRelease;
        $build = (!empty($this->build) ? '+' : '') . $this->build;
        $versionString = $this->major . '.' . $this->minor . '.'  . $this->patch . $preRelease . $build;
        return $versionString;
    }
}
