<?php

namespace Tests\Support\Queue;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Queue\Task;
use Exception;

class ProblematicTask extends Task
{
    public function execute(ContainerInterface $container): void
    {
        throw new Exception("I'm just being difficult.");
    }
}
