<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Throwable;

class ErrorCommand extends Command
{
    public function getName(): string
    {
        return "error";
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        $throwable = $container->typehintClass(Throwable::class);

        $terminal->write(
            sprintf(
                "Something went wrong. %s was thrown with the message \"%s\".",
                get_class($throwable),
                $throwable->getMessage()
            )
        );

        return 1;
    }
}
