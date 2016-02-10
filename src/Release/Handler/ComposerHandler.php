<?php

namespace Release\Handler;

use Release\IO\ComposerIO;
use Release\Version;

class ComposerHandler extends Handler
{
    public function __construct(ComposerIO $io)
    {

    }

    public function getVersion()
    {
        return new Version();
    }

    public function setVersion(Version $version)
    {

    }
}
