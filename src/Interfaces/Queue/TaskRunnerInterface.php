<?php

namespace Centum\Interfaces\Queue;

interface TaskRunnerInterface
{
    public function execute(TaskInterface $task): void;
}
