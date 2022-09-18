<?php

namespace Tests\Support\Commands\Middleware;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Tests\Support\Middlewares\Console\FalseMiddleware;
use Tests\Support\Middlewares\Console\TrueMiddleware;

class Multiple2Command extends Command
{
    public function getName(): string
    {
        return "middleware:false-true";
    }

    public function getMiddlewares(): array
    {
        return [
            new FalseMiddleware(),
            new TrueMiddleware(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        return 0;
    }
}
