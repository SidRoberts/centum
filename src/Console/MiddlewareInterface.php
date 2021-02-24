<?php

namespace Centum\Console;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;

interface MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, Container $container) : bool;
}
