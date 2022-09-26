<?php

namespace Centum\Interfaces\Queue;

interface QueueInterface
{
    public function publish(TaskInterface $task): void;

    public function consume(): TaskInterface;
}
