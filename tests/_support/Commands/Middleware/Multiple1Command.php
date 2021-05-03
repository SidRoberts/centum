<?php

namespace Tests\Commands\Middleware;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Tests\Middlewares\Console\FalseMiddleware;
use Tests\Middlewares\Console\TrueMiddleware;

class Multiple1Command extends Command
{
    public function getName(): string
    {
        return "middleware:true-false";
    }

    public function getMiddlewares(): array
    {
        return [
            new TrueMiddleware(),
            new FalseMiddleware(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        return 0;
    }
}
