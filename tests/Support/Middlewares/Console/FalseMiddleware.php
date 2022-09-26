<?php

namespace Tests\Support\Middlewares\Console;

use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

class FalseMiddleware implements MiddlewareInterface
{
    public function middleware(TerminalInterface $terminal, CommandInterface $command, ContainerInterface $container): bool
    {
        return false;
    }
}
