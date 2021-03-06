<?php

namespace Centum\Console\Command;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Centum\Queue\Queue;

class ProcessTaskCommand extends Command
{
    public function getName() : string
    {
        return "process-task";
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters) : int
    {
        /**
         * @var Queue
         */
        $queue = $container->typehintClass(Queue::class);

        $queue->processNextTask();

        return 0;
    }
}
