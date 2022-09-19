<?php

namespace Centum\Console\Middleware;

use Centum\Console\Command;
use Centum\Container\Container;
use Centum\Console\MiddlewareInterface;
use Centum\Console\Terminal;

class TrueMiddleware implements MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, Container $container): bool
    {
        return true;
    }
}
