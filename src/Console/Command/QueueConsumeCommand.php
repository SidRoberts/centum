<?php

namespace Centum\Console\Command;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Queue\Queue;

class QueueConsumeCommand extends Command
{
    public function getName(): string
    {
        return "queue-consume";
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        $queue = $container->get(Queue::class);

        $queue->consume();

        return 0;
    }
}
