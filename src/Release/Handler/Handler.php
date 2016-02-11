<?php

namespace Release\Handler;

use Release\IO\IOInterface;
use Release\Version;

abstract class Handler
{

    public function __construct(IOInterface $io)
    {
    }

    /**
     * @brief Return a Version object
     * @return Release\Version
     */
    abstract protected function getVersion();

    /**
     * @brief Set a Version object
     * @param Release\Version
     */
    abstract protected function setVersion(Version $version);
}
