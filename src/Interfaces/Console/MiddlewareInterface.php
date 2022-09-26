<?php

namespace Centum\Interfaces\Console;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Interfaces\Container\ContainerInterface;

interface MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, ContainerInterface $container): bool;
}
