<?php

namespace Tests\Console\Command\Middleware;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Tests\Console\Middleware\ExampleTrue;
use Tests\Console\Middleware\ExampleFalse;

class Multiple2Command extends Command
{
    public function getName() : string
    {
        return "middleware:false-true";
    }

    public function getMiddlewares() : array
    {
        return [
            new ExampleFalse(),
            new ExampleTrue(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, array $params) : int
    {
        return 0;
    }
}
