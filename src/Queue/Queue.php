<?php

namespace Centum\Queue;

use Centum\Container\Container;
use Pheanstalk\Pheanstalk;
use Throwable;

class Queue
{
    protected Container $container;
    protected Pheanstalk $pheanstalk;



    public function __construct(Container $container, Pheanstalk $pheanstalk)
    {
        $this->container = $container;
        $this->pheanstalk = $pheanstalk;
    }



    public function put(Task $task) : void
    {
        $this->pheanstalk->put(
            serialize($task)
        );
    }

    public function processNextTask() : Task
    {
        $job = $this->pheanstalk->reserve();

        /**
         * @var Task
         */
        $task = unserialize(
            $job->getData()
        );

        try {
            $task->execute($this->container);

            $this->pheanstalk->delete($job);
        } catch (Throwable $e) {
            $this->pheanstalk->bury($job);
        }

        return $task;
    }
}
