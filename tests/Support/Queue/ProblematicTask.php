<?php

namespace Tests\Support\Queue;

use Centum\Container\Container;
use Centum\Queue\Task;
use Exception;

class ProblematicTask extends Task
{
    public function execute(Container $container): void
    {
        throw new Exception("I'm just being difficult.");
    }
}