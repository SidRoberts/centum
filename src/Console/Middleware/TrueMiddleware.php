<?php

namespace Centum\Console\Middleware;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Container\ContainerInterface;

class TrueMiddleware implements MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, ContainerInterface $container): bool
    {
        return true;
    }
}
