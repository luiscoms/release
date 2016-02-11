<?php
// valid structures
return array(
    array( # first
        'expected' => '0.0.1',
        'content' => '{
    "name": "dummy/project",
    "version": "0.0.1"
}
'
    ),
    array( # second
        'expected' => '1.5.9',
        'content' => '{
    "name": "dummy/project",
    "version": "1.5.9",
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
    ),
    array( # third
        'expected' => '1.0.4',
        'content' => '{
    "name": "dummy/project",
    "version": "1.0.4",
    "require": {
        "monolog/monolog": "^1.17"
    }
}
'
    )
);
