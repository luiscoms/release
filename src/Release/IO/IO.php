<?php

namespace Release\IO;

interface IO
{
    public function load();
    public function save($data);
}
