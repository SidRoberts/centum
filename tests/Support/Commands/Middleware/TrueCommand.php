<?php

namespace Tests\Support\Commands\Middleware;

use Centum\Console\Command;
use Centum\Console\MiddlewareInterface;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Container\ContainerInterface;
use Tests\Support\Middlewares\Console\TrueMiddleware;

class TrueCommand extends Command
{
    public function getName(): string
    {
        return "middleware:true";
    }

    public function getMiddleware(): MiddlewareInterface
    {
        return new TrueMiddleware();
    }

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        return 0;
    }
}
