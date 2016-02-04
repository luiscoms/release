<?php
// valid structures
return array(
    array( # first
        'expected' => '',
        'projectRoot' => 'one',
        'fromDir' => '',
    ),
    array( # second
        'expected' => '',
        'projectRoot' => 'two',
        'fromDir' => 'sub',
    ),
    array( # third
        'expected' => '',
        'projectRoot' => 'three',
        'fromDir' => 'sub/dir',
    )
);
