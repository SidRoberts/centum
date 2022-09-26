<?php

namespace Centum\Interfaces\Console;

use Centum\Console\Terminal;
use Centum\Interfaces\Container\ContainerInterface;

interface MiddlewareInterface
{
    public function middleware(Terminal $terminal, CommandInterface $command, ContainerInterface $container): bool;
}
