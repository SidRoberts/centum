<?php

namespace Centum\Queue;

use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Centum\Queue\Exception\NoTasksInQueueException;
use Throwable;

class ArrayQueue implements QueueInterface
{
    /**
     * @var list<TaskInterface>
     */
    protected array $tasks = [];

    /**
     * @var list<TaskInterface>
     */
    protected array $buriedTasks = [];



    public function __construct(
        protected readonly TaskRunnerInterface $taskRunner
    ) {
    }



    public function publish(TaskInterface $task): void
    {
        $this->tasks[] = $task;
    }

    /**
     * @throws NoTasksInQueueException
     * @throws Throwable
     */
    public function consume(): TaskInterface
    {
        if (count($this->tasks) === 0) {
            throw new NoTasksInQueueException();
        }

        $task = array_shift($this->tasks);

        try {
            $this->taskRunner->execute($task);
        } catch (Throwable $e) {
            $this->buriedTasks[] = $task;

            throw $e;
        }

        return $task;
    }



    /**
     * @return list<TaskInterface>
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    /**
     * @return list<TaskInterface>
     */
    public function getBuriedTasks(): array
    {
        return $this->buriedTasks;
    }
}
