<?php

namespace Centum\Tests\Console\Command\Middleware;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Centum\Tests\Console\Middleware\ExampleTrue;
use Centum\Tests\Console\Middleware\ExampleFalse;

class Multiple1Command extends Command
{
    public function getName() : string
    {
        return "middleware:true-false";
    }

    public function getMiddlewares() : array
    {
        return [
            new ExampleTrue(),
            new ExampleFalse(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, array $params) : int
    {
        return 0;
    }
}
