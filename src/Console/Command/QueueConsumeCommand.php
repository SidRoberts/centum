<?php

namespace Centum\Console\Command;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Centum\Queue\Queue;

class QueueConsumeCommand extends Command
{
    public function getName(): string
    {
        return "queue-consume";
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        /**
         * @var Queue
         */
        $queue = $container->typehintClass(Queue::class);

        $queue->consume();

        return 0;
    }
}
