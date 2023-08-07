<?php

namespace Centum\Queue;

use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Centum\Queue\Exception\NoTasksInQueueException;
use Throwable;

class ArrayQueue implements QueueInterface
{
    /** @var array<TaskInterface> */
    protected array $tasks = [];

    /** @var array<TaskInterface> */
    protected array $buriedTasks = [];



    public function __construct(
        protected readonly TaskRunnerInterface $taskRunner
    ) {
    }



    public function publish(TaskInterface $task): void
    {
        $this->tasks[] = $task;
    }

    public function consume(): TaskInterface
    {
        $task = array_shift($this->tasks) ?? throw new NoTasksInQueueException();

        try {
            $this->taskRunner->execute($task);
        } catch (Throwable $e) {
            $this->buriedTasks[] = $task;

            throw $e;
        }

        return $task;
    }



    /**
     * @return array<TaskInterface>
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    /**
     * @return array<TaskInterface>
     */
    public function getBuriedTasks(): array
    {
        return $this->buriedTasks;
    }
}
