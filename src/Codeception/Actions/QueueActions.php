<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Queue\ArrayQueue;
use Centum\Queue\ImmediateQueue;
use Centum\Queue\TaskRunner;
use Exception;

trait QueueActions
{
    abstract public function grabContainer(): ContainerInterface;



    /**
     * Grab the Queue from the Container.
     */
    public function grabQueue(): QueueInterface
    {
        $container = $this->grabContainer();

        $queue = $container->get(QueueInterface::class);

        return $queue;
    }

    public function useArrayQueue(): void
    {
        $container = $this->grabContainer();

        $taskRunner = new TaskRunner($container);

        $queue = new ArrayQueue($taskRunner);

        $container->set(QueueInterface::class, $queue);
    }

    public function useImmediateQueue(): void
    {
        $container = $this->grabContainer();

        $taskRunner = new TaskRunner($container);

        $queue = new ImmediateQueue($taskRunner);

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

        if (!($queue instanceof ArrayQueue) && !($queue instanceof ImmediateQueue)) {
            throw new Exception(
                sprintf(
                    "Can only retreive tasks buried from an %s or %s instance.",
                    ArrayQueue::class,
                    ImmediateQueue::class
                )
            );
        }

        return $queue->getBuriedTasks();
    }



    public function executeTask(TaskInterface $task): void
    {
        $container = $this->grabContainer();

        $taskRunner = new TaskRunner($container);

        $taskRunner->execute($task);
    }
}
