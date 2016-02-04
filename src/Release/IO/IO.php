<?php

namespace Release\IO;

use Release\Version;

interface IO
{
    public function load();
    public function save(Version $version);
}
