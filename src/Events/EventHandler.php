<?php

namespace Centum\Events;

use Centum\Container\Container;
use Pheanstalk\Pheanstalk;
use Throwable;

class EventHandler
{
    protected Container $container;

    protected Pheanstalk $pheanstalk;



    public function __construct(Container $container, Pheanstalk $pheanstalk)
    {
        $this->container  = $container;
        $this->pheanstalk = $pheanstalk;
    }



    public function handle(EventInterface $event): void
    {
        $this->pheanstalk->put(
            serialize($event)
        );
    }



    public function process(): EventInterface
    {
        $job = $this->pheanstalk->reserve();

        /**
         * @var EventInterface
         */
        $event = unserialize(
            $job->getData()
        );

        try {
            $event->handle($this->container);

            $this->pheanstalk->delete($job);
        } catch (Throwable $e) {
            $this->pheanstalk->bury($job);
        }

        return $event;
    }
}
