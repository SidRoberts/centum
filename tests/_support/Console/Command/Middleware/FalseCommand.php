<?php

namespace Centum\Tests\Console\Command\Middleware;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Centum\Tests\Console\Middleware\ExampleTrue;
use Centum\Tests\Console\Middleware\ExampleFalse;

class FalseCommand extends Command
{
    public function getName() : string
    {
        return "middleware:false";
    }

    public function getMiddlewares() : array
    {
        return [
            new ExampleFalse(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, array $params) : int
    {
        return 0;
    }
}
