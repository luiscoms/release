<?php

namespace Release\IO;

interface IOInterface
{
    public function load();
    public function save($data);
}
