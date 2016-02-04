<?php
// valid structures
return array(
    array( # first
        'expected' => '{
    "name": "dummy/project",
    "authors": [
        {
            "name": "Dev",
            "email": "dev@luiscoms.com.br"
        }
    ],
    "require": {}
}
',
        'baseStructure' => __DIR__,
        'projectRoot' => 'one',
        'fromDir' => '',
    ),
    array( # second
        'expected' => '{
    "name": "dummy/project",
    "version": "1.5",
    "require": {
        "monolog/monolog": "^1.17"
    },
    "authors": [
        {
            "name": "Dev",
            "email": "dev@luiscoms.com.br"
        }
    ]
}
',
        'baseStructure' => __DIR__,
        'projectRoot' => 'two',
        'fromDir' => 'sub',
    ),
    array( # third
        'expected' => '{
    "name": "dummy/project",
    "version": "1.0.4",
    "require": {
        "monolog/monolog": "^1.17"
    }
}
',
        'baseStructure' => __DIR__,
        'projectRoot' => 'three',
        'fromDir' => 'sub/dir',
    )
);
