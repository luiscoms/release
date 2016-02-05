<?php

$baseStructure = dirname(__DIR__) . '/static/';
// valid structures
return array(
    array( # first
        'expected' => '{
    "name": "dummy/project",
    "require": {}
}
',
        'baseStructure' => $baseStructure,
        'projectRoot' => 'one',
        'fromDir' => '',
    ),
    array( # second
        'expected' => '{
    "name": "dummy/project",
    "version": "1.5.1",
    "require": {
        "monolog/monolog": "~1.17"
    },
    "authors": [
        {
            "name": "Dev",
            "email": "dev@luiscoms.com.br"
        }
    ]
}
',
        'baseStructure' => $baseStructure,
        'projectRoot' => 'two',
        'fromDir' => 'sub',
    ),
    array( # third
        'expected' => '{
    "name": "dummy/project",
    "version": "1.1.0",
    "require": {
        "monolog/monolog": "~1"
    }
}
',
        'baseStructure' => $baseStructure,
        'projectRoot' => 'three',
        'fromDir' => 'sub/dir',
    )
);
