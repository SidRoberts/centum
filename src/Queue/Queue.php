<?php

namespace Centum\Queue;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Pheanstalk\Contract\PheanstalkInterface;
use Pheanstalk\Job;
use Throwable;
use UnexpectedValueException;

class Queue implements QueueInterface
{
    protected readonly ContainerInterface $container;
    protected readonly PheanstalkInterface $pheanstalk;

    public const TUBE = "centum-tasks";



    public function __construct(ContainerInterface $container, PheanstalkInterface $pheanstalk)
    {
        $this->container  = $container;
        $this->pheanstalk = $pheanstalk;
    }



    public function publish(TaskInterface $task): void
    {
        $this->pheanstalk->useTube(self::TUBE);

        $this->pheanstalk->put(
            serialize($task)
        );
    }

    public function consume(): TaskInterface
    {
        $this->pheanstalk->watch(self::TUBE);

        /**
         * PheanstalkInterface::reserve() returns ?Job instead of just Job.
         * This is fixed in Pheanstalk v5 - not yet released.
         *
         * @var Job
         */
        $job = $this->pheanstalk->reserve();

        $task = unserialize(
            $job->getData()
        );

        if (!($task instanceof TaskInterface)) {
            throw new UnexpectedValueException(
                sprintf(
                    "Object from %s tube is not a %s object.",
                    self::TUBE,
                    TaskInterface::class
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
