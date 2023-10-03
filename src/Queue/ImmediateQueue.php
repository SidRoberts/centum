<?php

namespace Centum\Queue;

use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Centum\Queue\Exception\NoTasksInQueueException;
use Throwable;

class ImmediateQueue implements QueueInterface
{
    /**
     * @var array<TaskInterface>
     */
    protected array $buriedTasks = [];



    public function __construct(
        protected readonly TaskRunnerInterface $taskRunner
    ) {
    }



    /**
     * @throws Throwable
     */
    public function publish(TaskInterface $task): void
    {
        try {
            $this->taskRunner->execute($task);
        } catch (Throwable $e) {
            $this->buriedTasks[] = $task;

            throw $e;
        }
    }

    /**
     * @return never
     *
     * @throws NoTasksInQueueException
     */
    public function consume(): TaskInterface
    {
        throw new NoTasksInQueueException();
    }



    /**
     * @return array<TaskInterface>
     */
    public function getBuriedTasks(): array
    {
        return $this->buriedTasks;
    }
}
