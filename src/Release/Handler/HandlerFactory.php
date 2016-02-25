<?php

namespace Release\Handler;

/**
 * @brief Factory of Hanlders
 *
 * @param Classname to instantiate object, it should be a subclass of AbstractHandler
 * @return An Handler object, where Handlar is a subclass of AbstractHandler
 */
class HandlerFactory
{
    public static function create($class = 'ComposerHandler')
    {
        switch ($class) {
            case 'ComposerHandler':
            default:
                $handler = new ComposerHandler(new \Release\IO\ComposerIO(getcwd()));
        }
        return $handler;
    }
}
