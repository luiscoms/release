<?php

namespace Release\Event;

class EventManager
{
    private $events;

    public function __construct()
    {
        $this->events = new \SplPriorityQueue;
    }

    public function attach($name, $callback, $priority = 0)
    {
        $this->events->insert(array($name, $callback), $priority);
    }

    public function trigger($name, $params = array(), $callback = null)
    {
        foreach ($this->events as $event) {
            if ($event[0] == $name) {
                $e = new Event($name, $params);
                if ($r = $event[1]($e)) {
                    if (is_callable($callback)) {
                        $callback($r);
                    }
                }
            }
        }
    }
}
