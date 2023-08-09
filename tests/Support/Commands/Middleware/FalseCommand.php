<?php

namespace Tests\Support\Commands\Middleware;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Tests\Support\Middlewares\Console\FalseMiddleware;

#[CommandMetadata("middleware:false")]
class FalseCommand extends Command
{
    public function getMiddleware(): MiddlewareInterface
    {
        return new FalseMiddleware();
    }

    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
    {
        return self::SUCCESS;
    }
}
