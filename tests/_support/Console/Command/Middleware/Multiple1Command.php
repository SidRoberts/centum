<?php

namespace Tests\Console\Command\Middleware;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Tests\Console\Middleware\ExampleTrue;
use Tests\Console\Middleware\ExampleFalse;

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

    public function execute(Terminal $terminal, Container $container, Parameters $parameters) : int
    {
        return 0;
    }
}
