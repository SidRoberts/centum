<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Centum\Queue\ArrayQueue;
use Centum\Queue\ImmediateQueue;
use Exception;

trait QueueActions
{
    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    abstract public function grabFromContainer(string $class): object;

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     * @param T $object
     */
    abstract public function addToContainer(string $class, object $object): void;



    /**
     * Grab the Queue from the Container.
     */
    public function grabQueue(): QueueInterface
    {
        return $this->grabFromContainer(QueueInterface::class);
    }

    public function grabTaskRunner(): TaskRunnerInterface
    {
        return $this->grabFromContainer(TaskRunnerInterface::class);
    }



    public function useArrayQueue(): void
    {
        $taskRunner = $this->grabTaskRunner();

        $queue = new ArrayQueue($taskRunner);

        $this->addToContainer(QueueInterface::class, $queue);
    }

    public function useImmediateQueue(): void
    {
        $taskRunner = $this->grabTaskRunner();

        $queue = new ImmediateQueue($taskRunner);

        $this->addToContainer(QueueInterface::class, $queue);
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
        $taskRunner = $this->grabTaskRunner();

        $taskRunner->execute($task);
    }
}
