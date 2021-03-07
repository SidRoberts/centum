<?php

namespace Tests\Console\Command\Middleware;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Tests\Console\Middleware\ExampleTrue;

class TrueCommand extends Command
{
    public function getName() : string
    {
        return "middleware:true";
    }

    public function getMiddlewares() : array
    {
        return [
            new ExampleTrue(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters) : int
    {
        return 0;
    }
}
