<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Container\ContainerInterface;
use Throwable;

class ErrorCommand extends Command
{
    public function getName(): string
    {
        return "error";
    }

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        $throwable = $container->get(Throwable::class);

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
