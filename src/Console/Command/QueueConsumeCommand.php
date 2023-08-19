<?php

namespace Centum\Console\Command;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Queue\QueueInterface;

#[CommandMetadata("queue:consume")]
class QueueConsumeCommand implements CommandInterface
{
    public function __construct(
        protected readonly QueueInterface $queue
    ) {
    }

    public function execute(TerminalInterface $terminal): int
    {
        $this->queue->consume();

        return self::SUCCESS;
    }
}
