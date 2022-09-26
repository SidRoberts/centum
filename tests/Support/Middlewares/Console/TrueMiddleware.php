<?php

namespace Tests\Support\Middlewares\Console;

use Centum\Console\Terminal;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Container\ContainerInterface;

class TrueMiddleware implements MiddlewareInterface
{
    public function middleware(Terminal $terminal, CommandInterface $command, ContainerInterface $container): bool
    {
        return true;
    }
}
