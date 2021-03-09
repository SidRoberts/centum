<?php

namespace Tests\Console\Command;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

class InvalidConvertersCommand extends Command
{
    public function getName() : string
    {
        return "invalid-converters";
    }

    public function getConverters() : array
    {
        return [
            "a" => new Terminal(),
            "b" => new Container(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters) : int
    {
        return 0;
    }
}
