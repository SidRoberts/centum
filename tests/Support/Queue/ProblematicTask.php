<?php

namespace Tests\Support\Queue;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Exception;

final class ProblematicTask implements TaskInterface
{
    public function execute(ContainerInterface $container): void
    {
        throw new Exception("I'm just being difficult.");
    }
}
