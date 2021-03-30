<?php

namespace Centum\Console;

use Centum\Container\Container;

interface MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, Container $container): bool;
}
