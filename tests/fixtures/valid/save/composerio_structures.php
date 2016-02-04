<?php
// valid structures
return array(
    array( # first
        'expected' => '{
    "name": "dummy/project",
    "require": {}
}
',
        'baseStructure' => dirname(__DIR__) . '/static/',
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
        'baseStructure' => dirname(__DIR__) . '/static/',
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
        'baseStructure' => dirname(__DIR__) . '/static/',
        'projectRoot' => 'three',
        'fromDir' => 'sub/dir',
    )
);
