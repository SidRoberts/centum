<?php

namespace Centum\Queue;

use Centum\Container\Container;
use Pheanstalk\Pheanstalk;
use Throwable;
use UnexpectedValueException;

class Queue
{
    protected readonly Container $container;
    protected readonly Pheanstalk $pheanstalk;

    public const TUBE = "centum-tasks";



    public function __construct(Container $container, Pheanstalk $pheanstalk)
    {
        $this->container  = $container;
        $this->pheanstalk = $pheanstalk;
    }



    public function publish(Task $task): void
    {
        $this->pheanstalk->useTube(self::TUBE);

        $this->pheanstalk->put(
            serialize($task)
        );
    }

    public function consume(): Task
    {
        $this->pheanstalk->watch(self::TUBE);

        $job = $this->pheanstalk->reserve();

        $task = unserialize(
            $job->getData()
        );

        if (!($task instanceof Task)) {
            throw new UnexpectedValueException(
                sprintf(
                    "Object from %s tube is not a %s object.",
                    self::TUBE,
                    Task::class
                )
            );
        }

        try {
            $task->execute($this->container);

            $this->pheanstalk->delete($job);
        } catch (Throwable $e) {
            $this->pheanstalk->bury($job);

            throw $e;
        }

        return $task;
    }
}
