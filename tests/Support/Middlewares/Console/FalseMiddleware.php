<?php

namespace Tests\Support\Middlewares\Console;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Container\ContainerInterface;

class FalseMiddleware implements MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, ContainerInterface $container): bool
    {
        return false;
    }
}
