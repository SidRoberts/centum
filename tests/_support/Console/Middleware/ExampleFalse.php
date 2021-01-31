<?php

namespace Centum\Tests\Console\Middleware;

use Centum\Console\Command;
use Centum\Console\MiddlewareInterface;
use Centum\Console\Terminal;
use Centum\Container\Container;

class ExampleFalse implements MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $route, Container $container) : bool
    {
        return false;
    }
}
