<?php

namespace Centum\Queue;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;

class TaskRunner implements TaskRunnerInterface
{
    public function __construct(
        protected readonly ContainerInterface $container
    ) {
    }



    public function execute(TaskInterface $task): void
    {
        $task->execute(
            $this->container
        );
    }
}
