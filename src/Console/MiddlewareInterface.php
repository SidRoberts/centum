<?php

namespace Centum\Console;

use Centum\Interfaces\Container\ContainerInterface;

interface MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, ContainerInterface $container): bool;
}
