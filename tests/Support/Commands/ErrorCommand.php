<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Throwable;

class ErrorCommand extends Command
{
    public function getName(): string
    {
        return "error";
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int
    {
        $throwable = $container->get(Throwable::class);

        $terminal->write(
            sprintf(
                "Something went wrong. %s was thrown with the message \"%s\".",
                get_class($throwable),
                $throwable->getMessage()
            )
        );

        return self::FAILURE;
    }
}
