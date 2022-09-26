<?php

namespace Tests\Support\Commands\Middleware;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Console\TerminalInterface;
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

    public function execute(TerminalInterface $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        return 0;
    }
}
