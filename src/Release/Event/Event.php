<?php

namespace Release\Event;

class Event
{
    private $name;
    private $params;

    public function __construct($name, $params = array())
    {
        $this->name = $name;
        $this->params = $params;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getParams()
    {
        return $this->params;
    }
}
