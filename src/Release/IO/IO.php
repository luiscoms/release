<?php

namespace Release\IO;

interface IO
{
    public function load();
    public function save(Release\Version $version);
}
