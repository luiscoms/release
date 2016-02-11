<?php

$exceptionMessage = '/Failed to save file.*/';

// structures
return array(
    array( # first
        'expected' => $exceptionMessage,
        'baseStructure' => __DIR__,
        'projectRoot' => 'one',
        'fromDir' => '',
    ),
    array( # second
        'expected' => $exceptionMessage,
        'baseStructure' => __DIR__,
        'projectRoot' => 'two',
        'fromDir' => 'sub',
    ),
    array( # third
        'expected' => $exceptionMessage,
        'baseStructure' => __DIR__,
        'projectRoot' => 'three',
        'fromDir' => 'sub/dir',
    )
);
