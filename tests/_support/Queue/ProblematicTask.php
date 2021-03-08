<?php

namespace Tests\Queue;

use Centum\Container\Container;
use Centum\Queue\Task;

class ProblematicTask extends Task
{
    public function execute(Container $container) : bool
    {
        throw new Exception("I'm just being difficult.");
    }
}
