<?php

namespace Centum\Console;

use Centum\Console\Middleware\TrueMiddleware;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;

abstract class Command implements CommandInterface
{
    public function getMiddleware(): MiddlewareInterface
    {
        return new TrueMiddleware();
    }



    abstract public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int;
}
