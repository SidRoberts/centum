<?php

namespace Tests\Support\Commands;

use Centum\Interfaces\Console\ExceptionHandlerInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Throwable;

class ThrowableExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(TerminalInterface $terminal, Throwable $throwable): void
    {
        $terminal->writeError(
            sprintf(
                "Something went wrong. %s was thrown with the message \"%s\".",
                $throwable::class,
                $throwable->getMessage()
            )
        );
    }
}
