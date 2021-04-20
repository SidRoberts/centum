<?php

namespace Tests\Console\Command\Middleware;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Tests\Console\Middleware\FalseMiddleware;

class FalseCommand extends Command
{
    public function getName(): string
    {
        return "middleware:false";
    }

    public function getMiddlewares(): array
    {
        return [
            new FalseMiddleware(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        return 0;
    }
}
