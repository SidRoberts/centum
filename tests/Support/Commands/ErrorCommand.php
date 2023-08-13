<?php

namespace Tests\Support\Commands;

use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Throwable;

class ErrorCommand implements CommandInterface
{
    public function __construct(
        protected readonly Throwable $throwable
    ) {
    }

    public function execute(TerminalInterface $terminal): int
    {
        $terminal->writeError(
            sprintf(
                "Something went wrong. %s was thrown with the message \"%s\".",
                get_class($this->throwable),
                $this->throwable->getMessage()
            )
        );

        return self::FAILURE;
    }
}
