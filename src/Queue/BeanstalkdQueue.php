<?php

namespace Centum\Queue;

use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Pheanstalk\Contract\PheanstalkInterface;
use Pheanstalk\Job;
use Throwable;
use UnexpectedValueException;

class BeanstalkdQueue implements QueueInterface
{
    public const string TUBE = "centum-tasks";



    public function __construct(
        protected readonly TaskRunnerInterface $taskRunner,
        protected readonly PheanstalkInterface $pheanstalk
    ) {
    }



    public function publish(TaskInterface $task): void
    {
        $this->pheanstalk->useTube(self::TUBE);

        $this->pheanstalk->put(
            serialize($task),
            PheanstalkInterface::DEFAULT_PRIORITY,
            PheanstalkInterface::DEFAULT_DELAY,
            600 // 10 minutes
        );
    }

    /**
     * @throws UnexpectedValueException
     * @throws Throwable
     */
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
            $this->taskRunner->execute($task);

            $this->pheanstalk->delete($job);
        } catch (Throwable $e) {
            $this->pheanstalk->bury($job);

            throw $e;
        }

        return $task;
    }
}
