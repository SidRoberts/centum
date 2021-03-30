<?php

namespace Tests\Queue;

use Centum\Container\Container;
use Centum\Queue\Task;

class DoNothingTask extends Task
{
    public function execute(Container $container): bool
    {
        return true;
    }
}
