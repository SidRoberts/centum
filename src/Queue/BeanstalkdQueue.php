<?php

namespace Centum\Queue;

use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Pheanstalk\Contract\PheanstalkPublisherInterface;
use Pheanstalk\Contract\PheanstalkSubscriberInterface;
use Pheanstalk\Values\TubeName;
use Throwable;
use UnexpectedValueException;

class BeanstalkdQueue implements QueueInterface
{
    public const string TUBE = "centum-tasks";



    public function __construct(
        protected readonly TaskRunnerInterface $taskRunner,
        protected readonly PheanstalkPublisherInterface $pheanstalkPublisher,
        protected readonly PheanstalkSubscriberInterface $pheanstalkSubscriber
    ) {
    }



    public function publish(TaskInterface $task): void
    {
        $this->pheanstalkPublisher->useTube(
            new TubeName(self::TUBE)
        );

        $this->pheanstalkPublisher->put(
            serialize($task),
            PheanstalkPublisherInterface::DEFAULT_PRIORITY,
            PheanstalkPublisherInterface::DEFAULT_DELAY,
            600 // 10 minutes
        );
    }

    /**
     * @throws UnexpectedValueException
     * @throws Throwable
     */
    public function consume(): TaskInterface
    {
        $this->pheanstalkSubscriber->watch(
            new TubeName(self::TUBE)
        );

        $job = $this->pheanstalkSubscriber->reserve();

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

            $this->pheanstalkSubscriber->delete($job);
        } catch (Throwable $e) {
            $this->pheanstalkSubscriber->bury($job);

            throw $e;
        }

        return $task;
    }
}
