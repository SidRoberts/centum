<?php

namespace Centum\Console\Command;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Queue\Queue;

class QueueConsumeCommand extends Command
{
    public function getName(): string
    {
        return "queue-consume";
    }

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        $queue = $container->get(Queue::class);

        $queue->consume();

        return 0;
    }
}
