<?php

namespace Tests\Support\Commands\Middleware;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Tests\Support\Middlewares\Console\TrueMiddleware;

#[CommandMetadata("middleware:true")]
class TrueCommand extends Command
{
    public function getMiddleware(): MiddlewareInterface
    {
        return new TrueMiddleware();
    }

    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
    {
        return self::SUCCESS;
    }
}
