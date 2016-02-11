<?php

namespace Release\Handler;

use Naneau\SemVer\Parser;
use Release\IO\ComposerIO;
use Release\Version;

class ComposerHandler extends Handler
{
    private $_io;

    public function __construct(ComposerIO $io)
    {
        $this->_io = $io;
    }

    public function getVersion()
    {

        list($major, $minor, $patch, $preRelease, $build) = $this->parseVersion();

        return new Version($major, $minor, $patch, $preRelease, $build);
    }

    public function setVersion(Version $version)
    {

    }

    private function parseVersion()
    {
        $ret = array(0, 0, 0, '', '');
        $json = json_decode($this->_io->load(), true);
        if (empty($json)) {
            // throw new \InvalidArgumentException("Invalid ");
            return $ret;
        }
        if (!isset($json['version'])) {
            // throw new \InvalidArgumentException("Invalid ");
            return $ret;
        }
        $vString = $json['version'];

        $vParsed = Parser::parse($vString);
        return array($vParsed->getMajor(), $vParsed->getMinor(), $vParsed->getPatch(), $vParsed->hasPreRelease() ? $vParsed->getPreRelease() : '', $vParsed->hasBuild() ? $vParsed->getPreBuild() : '');
    }
}
