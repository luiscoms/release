<?php
// valid structures
return array(
    array( # first
        'expected' => '',
        'baseStructure' => __DIR__,
        'projectRoot' => 'one',
        'fromDir' => '',
    ),
    array( # second
        'expected' => '',
        'baseStructure' => __DIR__,
        'projectRoot' => 'two',
        'fromDir' => 'sub',
    ),
    array( # third
        'expected' => '',
        'baseStructure' => __DIR__,
        'projectRoot' => 'three',
        'fromDir' => 'sub/dir',
    )
);
