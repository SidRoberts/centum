<?php

namespace Tests\Support\Middlewares\Console;

use Centum\Console\Command;
use Centum\Console\MiddlewareInterface;
use Centum\Console\Terminal;
use Centum\Container\Container;

class TrueMiddleware implements MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, Container $container): bool
    {
        return true;
    }
}
