#!/usr/bin/env php
<?php
require __DIR__.'/vendor/autoload.php';

use Release\Command\Version;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Version());
$application->run();
