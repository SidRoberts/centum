<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\TaskInterface;

trait TaskActions
{
    abstract public function grabContainer(): ContainerInterface;



    public function executeTask(TaskInterface $task): void
    {
        $container = $this->grabContainer();

        $task->execute($container);
    }
}
