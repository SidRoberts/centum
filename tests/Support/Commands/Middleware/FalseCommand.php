<?php

namespace Tests\Support\Commands\Middleware;

use Centum\Console\Command;
use Centum\Console\MiddlewareGroup;
use Centum\Console\MiddlewareInterface;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Container\ContainerInterface;
use Tests\Support\Middlewares\Console\FalseMiddleware;

class FalseCommand extends Command
{
    public function getName(): string
    {
        return "middleware:false";
    }

    public function getMiddleware(): MiddlewareInterface
    {
        return new FalseMiddleware();
    }

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        return 0;
    }
}
