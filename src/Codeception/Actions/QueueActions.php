<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Queue\ArrayQueue;
use Exception;

trait QueueActions
{
    abstract public function grabContainer(): ContainerInterface;



    public function grabQueue(): QueueInterface
    {
        $container = $this->grabContainer();

        $queue = $container->get(QueueInterface::class);

        return $queue;
    }

    public function useArrayQueue(): void
    {
        $container = $this->grabContainer();

        $queue = new ArrayQueue($container);

        $container->set(QueueInterface::class, $queue);
    }



    public function publishToQueue(TaskInterface $task): void
    {
        $queue = $this->grabQueue();

        $queue->publish($task);
    }

    public function consumeFromQueue(): TaskInterface
    {
        $queue = $this->grabQueue();

        $task = $queue->consume();

        return $task;
    }



    /**
     * @return array<TaskInterface>
     */
    public function grabQueueTasks(): array
    {
        $queue = $this->grabQueue();

        if (!($queue instanceof ArrayQueue)) {
            throw new Exception(
                sprintf(
                    "Can only retreive tasks from an %s instance.",
                    ArrayQueue::class
                )
            );
        }

        return $queue->getTasks();
    }

    /**
     * @return array<TaskInterface>
     */
    public function grabQueueBuriedTasks(): array
    {
        $queue = $this->grabQueue();

        if (!($queue instanceof ArrayQueue)) {
            throw new Exception(
                sprintf(
                    "Can only retreive tasks buried from an %s instance.",
                    ArrayQueue::class
                )
            );
        }

        return $queue->getBuriedTasks();
    }



    public function executeTask(TaskInterface $task): void
    {
        $container = $this->grabContainer();

        $task->execute($container);
    }
}
