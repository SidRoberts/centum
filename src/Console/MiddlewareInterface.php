<?php

namespace Centum\Console;

use Centum\Container\Container;
use Centum\Console\Command;
use Centum\Console\Terminal;

interface MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, Container $container) : bool;
}
