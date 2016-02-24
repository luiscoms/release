<?php

namespace Release\Handler;

use Naneau\SemVer\Parser;
use Release\Handler\Exception\HandlerException;
use Release\IO\ComposerIO;
use Release\Version;

class ComposerHandler extends AbstractHandler
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
        $ret = array(0, 0, 1, '', '');
        $json = json_decode($this->_io->load(), true);
        if (!is_array($json)) {
            throw new HandlerException("Couldn't parse version from io");
        }
        if (!isset($json['version'])) {
            return $ret;
        }
        $vString = $json['version'];

        $vParsed = Parser::parse($vString);
        return array($vParsed->getMajor(), $vParsed->getMinor(), $vParsed->getPatch(), $vParsed->hasPreRelease() ? $vParsed->getPreRelease() : '', $vParsed->hasBuild() ? $vParsed->getPreBuild() : '');
    }
}
