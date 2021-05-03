<?php

namespace Tests\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

class ErrorCommand extends Command
{
    public function getName(): string
    {
        return "error";
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        $terminal->write("Something went wrong.");

        return 1;
    }
}
