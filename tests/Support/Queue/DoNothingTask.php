<?php

namespace Tests\Support\Queue;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Queue\Task;

class DoNothingTask extends Task
{
    public function execute(ContainerInterface $container): void
    {
    }
}
