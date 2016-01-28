<?php

$bootstrapPath = dirname(dirname(realpath(__FILE__))). DIRECTORY_SEPARATOR;

set_include_path(
    implode(
        PATH_SEPARATOR,
        array_unique(
            array_merge(
                array(
                    $bootstrapPath . 'src',
                    $bootstrapPath . 'tests',
                ),
                explode(PATH_SEPARATOR, get_include_path())
            )
        )
    )
);

spl_autoload_register(
    function ($class) {
        $classPath = stream_resolve_include_path(
            str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php'
        );
        if ($classPath !== false) {
            require $classPath;
        }
    }
);
