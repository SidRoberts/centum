<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Throwable;

#[CommandMetadata("error")]
class ErrorCommand extends Command
{
    public function __construct(
        protected readonly Throwable $throwable
    ) {
    }

    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
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
