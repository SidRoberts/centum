<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

class InvalidMiddlewaresCommand extends Command
{
    public function getName(): string
    {
        return "invalid-middlewares";
    }

    public function getMiddlewares(): array
    {
        return [
            new Terminal(),
            new Container(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        return 0;
    }
}
