<?php

namespace Centum\Tests\Console\Command\Middleware;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Centum\Tests\Console\Middleware\ExampleTrue;

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

    public function execute(Terminal $terminal, Container $container, array $params) : int
    {
        return 0;
    }
}
