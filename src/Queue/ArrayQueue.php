<?php

namespace Centum\Queue;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Exception;
use Throwable;

class ArrayQueue implements QueueInterface
{
    protected readonly ContainerInterface $container;

    /** @var array<TaskInterface> */
    protected array $tasks = [];

    /** @var array<TaskInterface> */
    protected array $buriedTasks = [];



    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }



    public function publish(TaskInterface $task): void
    {
        $this->tasks[] = $task;
    }

    public function consume(): TaskInterface
    {
        $task = array_shift($this->tasks) ?? throw new Exception("No tasks in Queue.");

        try {
            $task->execute($this->container);
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
