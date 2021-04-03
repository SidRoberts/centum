<?php

namespace Tests\Console\Command\Middleware;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Tests\Console\Middleware\ExampleFalse;
use Tests\Console\Middleware\ExampleTrue;

class Multiple2Command extends Command
{
    public function getName(): string
    {
        return "middleware:false-true";
    }

    public function getMiddlewares(): array
    {
        return [
            new ExampleFalse(),
            new ExampleTrue(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        return 0;
    }
}
