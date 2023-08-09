<?php

namespace Centum\Console\Command;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Queue\QueueInterface;

#[CommandMetadata("queue-consume")]
class QueueConsumeCommand extends Command
{
    public function __construct(
        protected readonly QueueInterface $queue
    ) {
    }

    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
    {
        $this->queue->consume();

        return self::SUCCESS;
    }
}
