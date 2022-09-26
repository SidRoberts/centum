<?php

namespace Centum\Interfaces\Console;

use Centum\Interfaces\Container\ContainerInterface;

interface MiddlewareInterface
{
    public function middleware(TerminalInterface $terminal, CommandInterface $command, ContainerInterface $container): bool;
}
