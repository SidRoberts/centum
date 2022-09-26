<?php

namespace Tests\Support\Commands\Middleware;

use Centum\Console\Command;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
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

    public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int
    {
        return 0;
    }
}
